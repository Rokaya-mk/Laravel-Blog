<?php

namespace App\Http\Controllers;

use App\Events\PostCommented;
use App\Http\Requests\StoreComment;
use App\Mail\CommentPosted;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class PostCommentController extends Controller
{
    //uply middleware
    public function __construct()
    {
        $this->middleware('auth')->only(['store']);
    }
    public function store(StoreComment $request, Post $post){
        //dd($post);
        $comment = $post->comments()->create([
            'content' => $request->content,
            'user_id' => $request->user()->id
        ]);
       // Mail::to($post->user->email)->send(new CommentPosted($comment));
        //use queue
        //Mail::to($post->user->email)->queue(new CommentPosted($comment));
        //uses later 
        // $delai = now()->addMinutes(1);
        // Mail::to($post->user->email)->later($delai,new CommentPosted($comment));
        //use event & listener to send email
        event(new PostCommented($comment));
        return redirect()->back();
    }
}