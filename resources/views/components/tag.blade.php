
@foreach($tags as $tag)
    <span class="badge bg-success"><a href=" {{ route('posts.tag',['id' =>$tag->id]) }} " style="color: #fff"> {{ $tag->name }} </a></span>
@endforeach