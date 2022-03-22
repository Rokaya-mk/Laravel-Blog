@auth
<form method="POST" action=" {{$action}} ">
    @csrf
    <h5>Add Comment</h5>
    <textarea class="form-control my-3" name="content" id="content"  rows="3"></textarea>
    <button class="btn btn-primary btn-block " type="submit">Add Comment</button>
</form>
@else 
    <a href="{{ route('login') }}" class="btn btn-success btn-sm">Sign in</a> to post a comment!
@endauth