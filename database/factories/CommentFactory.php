<?php

use Faker\Generator as Faker;

$factory->define(\App\Comment::class, function (Faker $faker) {
    return [
        'author_name' => $faker->firstName.''.$this->faker->lastName,
        'post_id' => $faker->numberBetween(1,20),
        'comment_parent_id'=>0,
        'comment'=>$faker->text,
    ];
});
