<?php

namespace App\Http\Controllers;

use App\Http\Requests\StorePost;
use App\Models\Image;
use App\Models\Post;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class PostController extends Controller
{

    //construct
    public function __construct()
    {
        $this->middleware('auth')->except(['index', 'show', 'archive', 'all']);
    }

    //show non trashed posts
    public function index()
    {
    
       
        return view('posts.index', [
            'posts' => Post::postUserCommentsTags()->get(), 
            'tab' => 'list']);
    }

    //show trashed posts
    public function archive()
    {
        $posts = Post::onlyTrashed()->withCount('comments')->get();

        return view('posts.index', ['posts' => $posts, 'tab' => 'archive']);
    }
    //show all posts
    public function all()
    {

        $posts = Post::withTrashed()->withCount('comments')->get();


        return view('posts.index', ['posts' => $posts, 'tab' => 'all']);
    }


    public function show($id)
    {
        //add cache
        $post = Cache::remember("post-show-{$id}",60,function() use ($id){
            return Post::with(['comments','tags','comments.user'])->findOrFail($id);//eager method
        });
        return view('posts.show', [
            'post' => $post
        ]);
    }

    //create function
    public function create()
    {
        return view('posts.create');
    }
    //sotre post
    public function store(StorePost $request)
    {

        // $post = new Post();
        // $post->title = $request->input('title');
        // $post->content = $request->input('content');
        // $post->slug = Str::slug($post->title, '-');
        // $post->active = false;
        // $post->save();

       
        //Method 2 to store a post
        $data = $request->only(['title', 'content']);
        $data['slug'] = Str::slug($data['title'], '-');
        $data['active'] = false;
        $data['user_id'] = $request->user()->id;
        $post = Post::create($data);

         //store file 
         $hasFile= $request->hasFile('picture');
         if($hasFile){
             $path = $request->file('picture')->store('posts');
             $image = new Image(['path' => $path]);
             $post->image()->save($image);
             //dump($file);
            // dump($file->getClientOriginalName());
             //$file->store('myFiles');
            // $name2= Storage::putFileAs('myFiles',$file,random_int(1,100).'.'.$file->guessExtension());
             //dump(Storage::url($name2));
         }
 
        $request->session()->flash('status', 'post was created');
        return redirect()->route('posts.show',['post'=>$post]);
    }

    public function edit($id)
    {
        $post = Post::findOrFail($id);
        $this->authorize("update",$post);
        return view('posts.edit', [
            'post' => $post
        ]);
    }

    public function update(StorePost $request, $id)
    {
        $post = Post::findOrFail($id);
        //use gate denise
        // if(Gate::denies("post.update",$post)){
        //     abort(403,"you can not edit this post");
        // }
        $this->authorize("update",$post);

        $hasFile= $request->hasFile('picture');
         if($hasFile){
             $path = $request->file('picture')->store('posts');
             if($post->image){
                 Storage::delete($post->image->path);
                 $post->image->path = $path;
                 $post->image->save();
             }
             else{
                 $post->image->save(Image::create(['path' => $path]));
             }
            //  $image = new Image(['path' => $path]);
            // $post->image()->save($image);
            

         }
        $post->title = $request->input(['title']);
        $post->content = $request->input(['content']);
        $post->slug = Str::slug($request->input(['title']), '-');
        $post->save();
        $request->session()->flash('status', 'post was updated !!');
        return redirect()->route('posts.show',['post' => $post]);
    }

    public function destroy(Request $request, $id)
    {
        $post = Post::findOrFail($id);
        $this->authorize("delete",$post);
        $post->delete();
        $request->session()->flash('status', 'post was deleted !!');
        return redirect()->route('posts.index');
    }

    public function restore($id)
    {
        $post = Post::onlyTrashed()->whereId($id)->first();
        $this->authorize("restore",$post);
        $post->restore();
        return redirect()->route('posts.index')->with(['tab' => 'list']);
    }

    public function forceDelete($id)
    {
        $post = Post::onlyTrashed()->whereId($id)->first();
        $this->authorize("restore",$post);
        $post->forceDelete();
        return redirect()->back();
    }
}
