@extends('layouts.app')
@section('content')
<div class="row">
    <div class="col-8">
        @if($post->image)
            <img src=" {{ $post->image->url() }} " alt="no image" class="img-fluid rounded " style="max-height:300px" >
        @endif
        <h3>{{ $post->title }} </h3>
<p> {{ $post->content }} </p>
<em> {{ $post->created_at }} </em>
<p> Status:
    @if ($post->active)
        Enabled
    @else
        Disabled
    @endif

</p>
<x-tag :tags="$post->tags"></x-tag>
<h2>Comments</h2>
<div >
    {{-- comment page form  --}}
    {{-- @include('comments.form',['id' => $post->id]) --}}
    {{-- use comment-form component --}}
    <x-comment-form :action="route('posts.comment.store',['post'=>$post->id])"></x-comment-form>
    <x-comment-list :comments="$post->comments" ></x-comment-list>
</div>
    </div>
    <div class="col-4">
        @include('posts.sidebar')
    </div>
</div>

@endsection
