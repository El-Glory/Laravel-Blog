@extends('layout.app')

@section('content')

@foreach(auth()->user()->posts as $post)
<div>
    <div class="mt-5 bg-white p-3 rounded-md p-6">
        <img src="/storage/{{$post->image}}" class=" object-fill h-2/3 w-7/12">
    </div>
</div>


@endforeach
@endsection