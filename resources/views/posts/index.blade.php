@extends('layouts.app')
@section('content')
<div class="row">
    {{-- <nav class="nav nav-tabs nav-stacked my-4">
        <a class="nav-link @if($tab == 'list') active @endif " href="{{ route('posts.index')}} ">List</a>
        <a class="nav-link @if($tab == 'archive') active @endif " href=" {{ route('posts.archive')}} ">Archive</a>
        <a class="nav-link @if($tab == 'all') active @endif " href=" {{ route('posts.all')}} ">All</a>
    </nav> --}}
    <div class="col-8">
        
        <div class="my-3">
            <h4> {{$posts->count() }} Post(s) </h4>
        </div>
 
        <ul class="list-group">
            @forelse ($posts as $post )
            
            <li class="list-group-item">
               <p>
                   
                @if($post->created_at->diffInHours() < 1)
                    <x-badge type='success'>New</x-badge>
                 
                @else 
                <x-badge type='dark'>Old</x-badge>
                @endif

                @if($post->image)
                <img src=" {{ $post->image->url() }} " alt="no image" class="img-fluid rounded " style="max-height:300px" >
                @endif

               </p>
                @if($post->trashed())
                <del>
                    <h3> <a  href=" {{ route('posts.show',['post' => $post->id]) }} ">{{ $post->title }} </a>  </h3>
                </del>
                @else

                <h3> <a href=" {{ route('posts.show',['post' => $post->id]) }} ">{{ $post->title }} </a>  </h3>
                
                @endif
                <p> {{ $post->content }} </p>
                <p><x-tag :tags="$post->tags"></x-tag></p>
                {{-- <em> {{ $post->created_at->diffForHumans() }} </em> --}}
                
                @if ($post->comments_count)
                <div>
                    <x-badge type='success'>{{ $post->comments_count }} comments</x-badge>
             
                </div>
                @else
                <div>
                    <x-badge type='dark'>no comments</x-badge>
                   
                </div>

                @endif

                <x-updated :date="$post->updated_at" :name="$post->user->name" :id="$post->user->id" ></x-updated>
                {{-- <p>
                    {{ $post->updated_at->diffForHumans() }}, by {{ $post->user->name }}
                </p> --}}
            @auth
                @can('update',$post)
                <a class="btn btn-sm btn-warning" href=" {{ route('posts.edit',['post' => $post->id]) }}">Edit</a>
                @endcan
        
                @cannot('delete',$post)
                <span class="badge badge-danger"> you can't delete </span>
                @endcannot
                @if(!$post->deleted_at)
                @can('delete',$post)
                <form class="form-inline" method="POST" action=" {{route('posts.destroy',['post' => $post->id]) }} ">
                    @csrf
                    @method('DELETE')
        
                    <button class="btn btn-sm btn-danger" type="submit">Delete</button>
                </form>
                @endcan
                @else
                @can('restore',$post)
                <form class="form-inline" method="POST" action=" {{url('posts/'.$post->id.'/restore')}}">
                    @csrf
                    @method('PATCH')
        
                    <button class="btn btn-sm btn-success" type="submit">Restore</button>
                </form>
                @endcan
                @can('forceDelete',$post)
                <form class="form-inline" method="POST" action=" {{url('posts/'.$post->id.'/forceDelete')}}">
                    @csrf
                    @method('DELETE')
        
                    <button class="btn btn-sm btn-danger" type="submit">Force Delete</button>
                </form>
                @endcan
                @endif
            @endauth
            </li>
            @empty
                <span class="badge badge-danger">No post</span>
            @endforelse
        
        </ul>
    </div>
    <div class="col-4">
        @include('posts.sidebar')
    </div>
</div>

@endsection
