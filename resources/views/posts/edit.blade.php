@extends('layouts.app')
@section('content')
<h1>Edit Post</h1>
    <form method="POST" action=" {{route('posts.update',['post' => $post->id]) }} ">
        @csrf
        @method('PUT')
        @include('posts.form')
        <button class="btn btn-block btn-warning w-100" type="submit">Edit post</button>
    </form>
@endsection
