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