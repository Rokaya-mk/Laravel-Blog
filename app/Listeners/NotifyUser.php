<?php

namespace App\Listeners;

use App\Events\PostCommented;
use App\Mail\CommentPosted;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Mail;

class NotifyUser
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  object  $event
     * @return void
     */
    public function handle(PostCommented $event)
    { 
        Mail::to($event->comment->commentable->user->email)->queue(new CommentPosted($event->comment));
    }
}
