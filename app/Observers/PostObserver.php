<?php

namespace App\Observers;

use App\Models\Post;
use Illuminate\Support\Facades\Cache;

class PostObserver
{
    
    public function updating(Post $post)
    {
        Cache::forget("post-show-{$post->id}");
    }

    
    public function deleting(Post $post)
    {
        $post->comments()->delete();
    }

    public function restoring(Post $post)
    {
        $post->comments()->restore();
    }

}
