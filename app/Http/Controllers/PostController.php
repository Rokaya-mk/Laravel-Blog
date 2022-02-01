<?php

namespace App\Http\Controllers;

use App\Http\Requests\StorePost;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
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

        $posts = Post::withCount('comments')->get();


        return view('posts.index', ['posts' => $posts, 'tab' => 'list']);
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
        //dd('rrr');
        return view('posts.show', [
            'post' => Post::find($id)
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
        $post = Post::create($data);
        $request->session()->flash('status', 'post was created');
        return redirect()->route('posts.index');
    }

    public function edit($id)
    {
        $post = Post::findOrFail($id);
        return view('posts.edit', [
            'post' => $post
        ]);
    }

    public function update(StorePost $request, $id)
    {
        $post = Post::findOrFail($id);
        $post->title = $request->input(['title']);
        $post->content = $request->input(['content']);
        $post->slug = Str::slug($request->input(['title']), '-');
        $post->save();
        $request->session()->flash('status', 'post was updated !!');
        return redirect()->route('posts.index');
    }

    public function destroy(Request $request, $id)
    {
        $post = Post::findOrFail($id);
        $post->delete();
        $request->session()->flash('status', 'post was deleted !!');
        return redirect()->route('posts.index');
    }

    public function restore($id)
    {
        $post = Post::onlyTrashed()->whereId($id)->first();
        $post->restore();
        return redirect()->route('posts.index')->with(['tab' => 'list']);
    }

    public function forceDelete($id)
    {
        $post = Post::onlyTrashed()->whereId($id)->first();
        $post->forceDelete();
        return redirect()->back();
    }
}
