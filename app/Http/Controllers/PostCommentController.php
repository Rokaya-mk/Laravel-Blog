<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreComment;
use App\Models\Post;
use Illuminate\Http\Request;

class PostCommentController extends Controller
{
    //uply middleware
    public function __construct()
    {
        $this->middleware('auth')->only(['store']);
    }
    public function store(StoreComment $request, Post $post){
        //dd($post);
        $post->comments()->create([
            'content' => $request->content,
            'user_id' => $request->user()->id
        ]);
        return redirect()->back();
    }
}
