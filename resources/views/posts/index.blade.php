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
               </p>
                @if($post->trashed())
                <del>
                    <h3> <a  href=" {{ route('posts.show',['post' => $post->id]) }} ">{{ $post->title }} </a>  </h3>
                </del>
                @else

                <h3> <a href=" {{ route('posts.show',['post' => $post->id]) }} ">{{ $post->title }} </a>  </h3>
                
                @endif
                <p> {{ $post->content }} </p>
                <em> {{ $post->created_at->diffForHumans() }} </em>
                
                @if ($post->comments_count)
                <div>
                    <x-badge type='success'>{{ $post->comments_count }} comments</x-badge>
             
                </div>
                @else
                <div>
                    <x-badge type='dark'>no comments</x-badge>
                   
                </div>

                @endif

                <x-updated :date="$post->updated_at" :name="$post->user->name" ></x-updated>
                {{-- <p>
                    {{ $post->updated_at->diffForHumans() }}, by {{ $post->user->name }}
                </p> --}}
            @auth
                @can('update',$post)
                <a class="btn btn-warning" href=" {{ route('posts.edit',['post' => $post->id]) }}">Edit</a>
                @endcan
        
                @cannot('delete',$post)
                <span class="badge badge-danger"> you can't delete </span>
                @endcannot
                @if(!$post->deleted_at)
                @can('delete',$post)
                <form class="form-inline" method="POST" action=" {{route('posts.destroy',['post' => $post->id]) }} ">
                    @csrf
                    @method('DELETE')
        
                    <button class="btn btn-danger" type="submit">Delete</button>
                </form>
                @endcan
                @else
                @can('restore',$post)
                <form class="form-inline" method="POST" action=" {{url('posts/'.$post->id.'/restore')}}">
                    @csrf
                    @method('PATCH')
        
                    <button class="btn btn-success" type="submit">Restore</button>
                </form>
                @endcan
                @can('forceDelete',$post)
                <form class="form-inline" method="POST" action=" {{url('posts/'.$post->id.'/forceDelete')}}">
                    @csrf
                    @method('DELETE')
        
                    <button class="btn btn-danger" type="submit">Force Delete</button>
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
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Post Most Commented</h4>
                
            </div>
            <ul class="list-group list-group-flush">
                @foreach($mostCommented as $post)
                <li class="list-group-item">
                    <a href=""> {{ $post->title }}
                        <p>
                            <span class="badge bg-success"> {{ $post->comments_count }} </span>
                        </p>
                    </a>
                </li>
                @endforeach
            </ul>
        </div>
        
        {{-- <div class="card">
            <div class="card-body">
                <h4 class="card-title">Active Users</h4>
                <p>most active users posts</p>
            </div>
            <ul class="list-group list-group-flush">
                @foreach($mostAciveUsers as $user)
                <li class="list-group-item">
                    <a href=""> {{ $user->name }}
                        <p>
                            <span class="badge bg-success"> {{ $user->posts_count }} </span>
                        </p>
                    </a>
                </li>
                @endforeach
            </ul>
        </div> --}}

        <x-card 
            title="Active Users"
            content="most active users posts"
            :items="collect($mostAciveUsers)->pluck('name')"> 
        </x-card>
        <br>
        {{-- <div class="card">
            <div class="card-body">
                <h4 class="card-title">Active Users in last month</h4>     
            </div>
            <ul class="list-group list-group-flush">
                @foreach($activeUserLastMonth as $user)
                <li class="list-group-item">
                    <a href=""> {{ $user->name }}
                        <p>
                            <span class="badge bg-success"> {{ $user->posts_count }} </span>
                        </p>
                    </a>
                </li>
                @endforeach
            </ul>
        </div> --}}
        <x-card 
        title="Active Users in last month"
        content="most Active Users in last month"
        :items="collect($activeUserLastMonth)->pluck('name')"> 
    </x-card>
    </div>
</div>

@endsection
