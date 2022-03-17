@extends('layouts.app')
@section('content')

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
<h2>Comments</h2>
<ul class="list-group">
    @foreach($post->comments as $comment)
    <li class="list-group-item">
        <p> {{ $comment->content }} </p>
        <span> {{ $comment->updated_at->diffForHumans() }} </span>
    </li>
    @endforeach
</ul>
@endsection
