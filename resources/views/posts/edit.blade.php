@extends('layouts.app')
@section('content')
<h1>Edit Post</h1>
    <form class="container" method="POST" action=" {{route('posts.update',['post' => $post->id]) }} " enctype="multipart/form-data">
        @csrf
        @method('PUT')
        @include('posts.form')
        <button class="btn btn-block btn-warning" type="submit">Edit post</button>
    </form>
@endsection
