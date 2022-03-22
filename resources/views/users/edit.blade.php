@extends('layouts.app')
@section('content')
<form action=" {{ route('users.update',['user' => $user->id]) }} " method="POST" enctype="multipart/form-data">
    @method('PUT')
    @csrf
    <div class="row">
        <div class="col-md-4">
            <h5>Select an Avatar</h5>
            <img src=" {{($user->image) ? $user->image->url() : '' }} " alt="no image" class="img-thumbnail avatar">
            <input type="file" name="avatar" id="avatar" class="form-control-file">
        </div>
        <div class="col-md-8">
            <div class="form-group">
                <label for="name">User Name</label>
                <input type="text" id="name" class="form-control">
            </div>
        </div>
    </div>
    <button class="btn btn-block btn-warning " type="submit">Edit User</button>
</form>
@endsection