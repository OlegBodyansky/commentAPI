<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;

class Comment extends Model
{
    protected $fillable = ['post_id', 'comment_parent_id', 'author_name','comment' ];


    public function children()
    {
        return $this->hasMany(Comment::class, 'comment_parent_id');
    }

    public function getThreadedComments(){
        return $this->children()->get()->threaded();
    }

    public function getPostsIds()
    {
        return $this->select('post_id')->groupBy('post_id')->get();
    }


    public function getSubComments() {

            $sections = new Collection();

            foreach ($this->children as $section) {
                $sections->push($section);
                $sections = $sections->merge($section->getSubComments());
            }

            return $sections;
    }


}
