@extends('layouts.app')
@section('content')
<div class="row">
    <div class="col-8">
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
