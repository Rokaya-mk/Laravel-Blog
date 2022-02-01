@extends('layouts.app')
@section('content')
<nav class="nav nav-tabs nav-stacked my-4">
    <a class="nav-link @if($tab == 'list') active @endif " href="{{ route('posts.index')}} ">List</a>
    <a class="nav-link @if($tab == 'archive') active @endif " href=" {{ route('posts.archive')}} ">Archive</a>
    <a class="nav-link @if($tab == 'all') active @endif " href=" {{ route('posts.all')}} ">All</a>
</nav>
<div class="my-3">
    <h4> {{$posts->count() }} Post(s) </h4>
</div>
<ul class="list-group">
    @forelse ($posts as $post )
    <li class="list-group-item">
        <h3> <a href=" {{ route('posts.show',['post' => $post->id]) }} ">{{ $post->title }} </a>  </h3>
        <p> {{ $post->content }} </p>
        <em> {{ $post->created_at->diffForHumans() }} </em>
        @if ($post->comments_count)
        <div>
            <span class="badge bg-success"> {{ $post->comments_count }} comments </span>
        </div>
        @else
        <div>
            <span class="badge bg-dark"> no comments </span>
        </div>
        @endif

        <a class="btn btn-warning" href=" {{ route('posts.edit',['post' => $post->id]) }}">Edit</a>
        @if(!$post->deleted_at)
        <form class="form-inline" method="POST" action=" {{route('posts.destroy',['post' => $post->id]) }} ">
            @csrf
            @method('DELETE')

            <button class="btn btn-danger" type="submit">Delete</button>
        </form>
        @else
        <form class="form-inline" method="POST" action=" {{url('posts/'.$post->id.'/restore')}}">
            @csrf
            @method('PATCH')

            <button class="btn btn-success" type="submit">Restore</button>
        </form>
        <form class="form-inline" method="POST" action=" {{url('posts/'.$post->id.'/forceDelete')}}">
            @csrf
            @method('DELETE')

            <button class="btn btn-danger" type="submit">Force Delete</button>
        </form>
        @endif
    </li>
    @empty
        <span class="badge badge-danger">No post</span>
    @endforelse

</ul>
@endsection
