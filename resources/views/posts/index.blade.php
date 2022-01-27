@extends('layout')
@section('content')
<h1>list of Posts</h1>

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

        <form class="form-inline" method="POST" action=" {{route('posts.destroy',['post' => $post->id]) }} ">
            @csrf
            @method('DELETE')

            <button class="btn btn-danger" type="submit">Delete</button>
        </form>

    </li>
    @empty
        <span class="badge badge-danger">No post</span>
    @endforelse

</ul>
@endsection
