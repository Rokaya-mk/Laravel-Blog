<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreComment;
use App\Models\User;
use Illuminate\Http\Request;

class UserCommentController extends Controller
{
    //uply middleware
    public function __construct()
    {
        $this->middleware('auth')->only(['store']);
    }
    public function store(StoreComment $request, User $user){
        //dd($post);user
        $user->comments()->create([
            'content' => $request->content,
            'user_id' => $request->user()->id
        ]);
        return redirect()->back()->withStatus('Comment was Updated!');
    }
}
