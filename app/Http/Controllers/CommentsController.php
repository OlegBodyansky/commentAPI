<?php

namespace App\Http\Controllers;

use App\Comment;
use App\Http\Requests\CommentFormRequest;
use App\Http\Resources\RowDeleted;
use Illuminate\Http\Request;
use App\Http\Resources\Comment as CommentResource;
use Illuminate\Support\Collection;

class CommentsController extends Controller
{

    public function index()
    {
        $comments = Comment::where('comment_parent_id',0)->get();
        $comments->each(function($comment) {
            $comment['children'] =$comment->getSubComments();
        });

        return $comments;
    }

    public function list($post_id)
    {
        $comments = Comment::where([['post_id','=',$post_id], ['comment_parent_id','=',0]])->get();
        $comments->each(function($comment) {
            $comment['children'] =$comment->getSubComments();
        });
        return $comments;

    }

    public function postList()
    {   $comment = new Comment();
       return  $comment->getPostsIds()->pluck('post_id');
    }

    public function edit($id)
    {
        return Comment::whereId($id)->firstOrFail();

    }


    public function update(Request $request)
    {
        $comment = Comment::findOrFail($request->get('id'));
            $comment->update($request->all());

        $comment->save();

        return $comment;

    }


    public function store(Request $request)
    {
        $comment = new Comment([
            'post_id' => $request->get('post_id'),
            'comment_parent_id' =>!empty($comment_parent_id = $request->get('comment_parent_id'))?$comment_parent_id:0,
            'author_name' => !empty($author = $request->get('author_name'))?$author:'incognito',
            'comment' => $request->get('comment'),
        ]);

        $comment->save();

        return $comment;
    }

    public function destroy($id)
    {
        $comment = Comment::findOrFail($id);
        $sections =  $comment->getSubComments();
        $sections->push($comment);
        $sections->map(function($item){$item->delete();});
        return $sections->pluck('id');
    }


}
