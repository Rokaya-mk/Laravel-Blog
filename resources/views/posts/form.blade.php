<div class="form-group ">
    <label for="title">Your title</label>
    <input class="form-control" name="title" id="title" type="text" value=" {{ old('title', $post->title ?? null) }} ">
</div>
<div class="form-group">
    <label for="content">Your content</label>
    <input class="form-control" name="content" id="content" type="text" value=" {{ old('content', $post->content ?? null) }} ">
</div>
<div class="form-group">
    <label for="avatar">Picture</label>
    <input type="file" name="avatar" id="avatar" class="form-control">
</div>

<x-errors my-class="warning"></x-errors>
