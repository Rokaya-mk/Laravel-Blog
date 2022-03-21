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
    @include('comments.form',['id' => $post->id])
    @foreach($post->comments as $comment)

        <p> {{ $comment->content }} </p>
        <p class="text-muted">

            <x-updated :date="$comment->created_at" :name="$comment->user->name" ></x-updated>
        </p>
    
    @endforeach
</div>
    </div>
    <div class="col-4">
        @include('posts.sidebar')
    </div>
</div>

@endsection
