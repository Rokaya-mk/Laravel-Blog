<?php

namespace App\Http\Controllers;

use App\Models\Image;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class UserController extends Controller
{
    //add constructor
    public function __construct()
    {
        $this->middleware('auth');
        $this->authorizeResource(User::class,'user');
    }

    public function index()
    {
        //
    }

    public function show(User $user)
    {
        return view('users.show',['user' =>$user]);
    }

    public function edit(User $user)
    {
        return view('users.edit',['user' =>$user]);
    }

    public function update(Request $request, User $user)
    {
        $hasFile= $request->hasFile('avatar');
         if($hasFile){
             $path = $request->file('avatar')->store('users');
             if($user->image){
                 Storage::delete($user->image->path);
                 $user->image->path = $path;
                 $user->image->save();
                
             }
             else{
                 //$user->image->save(Image::create(['path' => $path]));
                 $user->image()->save(Image::make(['path' => $path]));
             }
        }
        return redirect()->back()->withStatus('User Updated!');
    }

    public function destroy(User $user)
    {
        //
    }
}
