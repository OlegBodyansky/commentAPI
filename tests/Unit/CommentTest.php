<?php

namespace Tests\Unit;

use App\Comment;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class CommentTest extends TestCase
{
    Use WithFaker;
    /**
     * A basic test example.
     *
     * @return void
     */
    public function testExample()
    {
        $this->assertTrue(true);
    }

    public function testItCanCreate()
    {

        $attributes = [
            'author_name' => $this->faker->firstName.''.$this->faker->lastName,
            'post_id' => $this->faker->numberBetween(1,20),
            'comment_parent_id'=>0,
            'comment'=>$this->faker->text,
        ];

        $response = $this->postJson('api/v1/comment/create',$attributes)->assertSuccessful();
        $model = new Comment();

        $this->assertDatabaseHas($model->getTable(), $attributes);

        return $response;
    }

    public function testItCanUpdate()
    {

        $comment = factory('App\Comment')->create();

        $attributes = [
            'id'=>$comment->id,
            'author_name' => $this->faker->firstName.''.$this->faker->lastName,
            'comment'=>$this->faker->text,
        ];
        $response = $this->postJson('api/v1/comment/update', $attributes)->assertSuccessful();

        tap($comment->fresh(), function ($model) use ($attributes) {
            collect($attributes)->each(function($value, $key) use ($model) {
                $this->assertEquals($value, $model[$key]);
            });
        });
        return $response;
    }

    public function it_can_destroy()
    {
        $comment = factory('App\Comment')->create();

        $this->assertDatabaseHas($comment->getTable(), ['id'=>$comment->id]);

        $response = $this->post('api/v1/comment/'.$comment->id.'/delete')->assertSuccessful();

        $this->assertDatabaseHas($comment->getTable(), ['id'=>$comment->id]);

        return $response;
    }

}
