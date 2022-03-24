<p>
    
    <a href=" {{ route('users.show',['user' => $comment->user->id])}} "> {{ $comment->user->name }} </a>
</p>
<p>
    has Commented Your Post 
    <a href="{{ route('posts.show',['post' =>$comment->commentable->id])}}"> {{ $comment->commentable->title }} </a>
</p>
<div>
    Content:
    <p>
        {{ $comment->content }}
    </p>
</div>
