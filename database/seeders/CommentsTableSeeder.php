<?php

namespace Database\Seeders;

use App\Models\Comment;
use App\Models\Post;
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
        $posts = Post::all();
        if ($posts->count() == 0) {
            $this->command->info("please generate some posts first!");
            return;
        }
        $nbComments = $this->command->ask("how many post you want to generate !", 30);
        Comment::factory($nbComments)->make()->each(function ($comment) use ($posts) {
            $comment->post_id = $posts->random()->id;
            $comment->save();
        });
    }
}
