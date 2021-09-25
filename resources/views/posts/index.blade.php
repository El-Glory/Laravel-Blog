@extends('layout.app')

@section('content')

@foreach(auth()->user()->posts as $post)
<div>

    <div class="mt-5 bg-white p-3 rounded-md p-6 w-7/12">
        <a href="{{route('posts.show', $post)}}">
            <div class="text-center">

                <h1 class="uppercase text-lg p-1">{{$post->title}}</h1>
                <span class="text-gray-600 text-sm">{{$post->created_at->diffForHumans()}}</span>
            </div>
            <img src="/storage/{{$post->image}}" class=" object-fill h-96 w-11/12 rounded-md p-2">
            <p>{{$post->body}}</p>
        </a>


    </div>

</div>



@endforeach

@endsection