<?php

namespace Tests\Feature;

use App\Models\Post;
use Illuminate\Support\Str;
use Tests\TestCase;

class PostTest extends TestCase
{

    public function testSavePost()
    {
        $post = new Post();
        $post->title = "title test";
        $post->content = "test content";
        $post->slug = Str::slug($post->title, '-');
        $post->active = false;
        $post->save();

        $this->assertDatabaseHas('posts', [
            'title' => 'title test'
        ]);
    }
}
