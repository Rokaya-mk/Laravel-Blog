@extends('layouts.app')
@section('content')
<h1>Create Post</h1>
    <form class="container" method="POST" action=" {{route('posts.store') }}" enctype="multipart/form-data">
        @csrf
        @include('posts.form')
        <button class="btn btn-primary w-100" type="submit">Add post</button>
    </form>
@endsection
