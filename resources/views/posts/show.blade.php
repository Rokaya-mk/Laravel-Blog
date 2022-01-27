@extends('layout')
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
@endsection
