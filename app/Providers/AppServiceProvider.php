<?php

namespace App\Providers;

use App\Http\ViewComposers\ActivityComposer;
use App\Models\Comment;
use App\Models\Post;
use App\Observers\CommentObserver;
use App\Observers\PostObserver;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        view()->composer('posts.sidebar',ActivityComposer::class);
        Post::observe(PostObserver::class);
        Comment::observe(CommentObserver::class);
    }
}
