@extends('auth.home')

@section('content')
<div class="flex justify-center">
    <div class="w-6/12 bg-white p-4 rounded-lg mt-4">
        <div class="flex justify-between p-3">
            <div>
                <p class="mt-1"></p>
            </div>
            <div class="">
                <a class="bg-blue-500 px-5 py-1 rounded-md text-white font-medium" type="submit" href="{{route('addPost')}}">Add</a>
            </div>
        </div>

        <div>
            @if(auth()->user()->posts->count())
            @foreach(auth()->user()->posts as $post)
            <div class="mb-4 bg-gray-200 p-4 rounded-lg justify-between flex">
                <div>
                    <p class="mb-2">{{$post->title}}</p><span class="text-gray-600 text-sm">{{$post->created_at->diffForHumans()}}</span>
                </div>

                <div>
                    <div class="flex items-center">
                        <ul class="p-3">
                            <li>
                                @method('PUT')
                                <a type="submit" class="bg-blue-500 rounded-sm text-white px-1.5 py-1.5 font-sm rounded-sm" href="{{route('edit', $post)}}">Edit</a>
                            </li>
                        </ul>


                        <form action="{{route('posts.destroy', $post)}}" method=" POST">
                            @method('DELETE')
                            @csrf
                            <button type="submit" class="bg-red-500 rounded-sm text-white px-1 py-1 font-sm rounded-sm">Delete</button>
                        </form>
                    </div>

                </div>


            </div>
            @endforeach

            @else
            <div class="p-2">
                <p class="flex justify-center italic">There are no posts at this time</p>
            </div>

            @endif
        </div>


    </div>
    @endsection