<?php

use Illuminate\Database\Seeder;

class CommentsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = \Faker\Factory::create();

        for($i=1; $i<=100; $i++){
            $num = $i<50?1:2;
            if($i==1 || $i==50) {
                $comments_parent=0;
            }else {
                $comments_parent = $i%5==0?0:$i-1;
            }

           DB::table('comments')
               ->insert([
                'post_id'  => $num ,
                   'comment_parent_id'=>$comments_parent,
                   'author_name'=>$faker->firstName.' '.$faker->lastName,
            'comment'=> $faker->paragraph,
                   'created_at'=>$faker->dateTimeThisYear(),
               ]);

        }
    }
}
