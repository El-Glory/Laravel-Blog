@extends('layout.app')

@section('content')
<div class="flex justify-center">
    <div class="w-full bg-white p-6 rounded-lg">

        <div class="text-center">
            <img src="/storage/{{$post->image}}" class=" max-h-screen w-full rounded-md p-2 justify-center">
        </div>
        <div>

            <h1 class="uppercase lg:text-3xl p-1 tracking-wider text-gray-500">{{$post->title}}</h1>
            <p class="ml-4">{{$post->body}}</p>
            <!-- <span class="text-gray-600 text-sm italic">{{$post->created_at->diffForHumans()}}</span> -->
        </div>

        <div>

        </div>


    </div>
</div>
@endsection