@extends('layout.app')

@section('content')
<div class="justify-center">
    <div class="w-full bg-white p-6 rounded-lg">

        <div class="text-center">
            <img src="/storage/{{$post->image}}" class=" max-h-screen w-full rounded-md p-2 justify-center">
        </div>
        <div>

            <h1 class="uppercase lg:text-3xl p-1 tracking-wider text-gray-500">{{$post->title}}</h1>
            <p class="ml-4">{{$post->body}}</p>
            <!-- <span class="text-gray-600 text-sm italic">{{$post->created_at->diffForHumans()}}</span> -->
        </div>
        @comments(['model' => $post])

    </div>

    <!-- <div class="w-8/12 bg-white p-10 rounded-lg mt-3 shadow-lg mb-6">
        <p class="italics text-center">Your email address would not be published</p>
        <form action="{{route('post.update', $post)}}" method="post" class="mb-4 mt-3" enctype="multipart/form-data">
            @csrf

            <div class="mb-4">
                <label for="body" class="sr-only">Body</label>
                <textarea name="body" id="body" cols="30" rows="4" class="bg-white border-2 w-full p-4 rounded-lg @error('body') border-red-500 @enderror" value="{{old('body')}}"></textarea>

                @error('body')
                <div class="text-red-500 mt-2 text-sm">
                    {{$message}}
                </div>
                @enderror
            </div>
            <div class="mb-4">
                <label for="name" class="sr-only">Name</label>
                <input name="name" id="name" cols="30" rows="4" class="bg-white border-2 w-full p-4 rounded-lg @error('name') border-red-500 @enderror" placeholder="Name" value="{{old('name')}}"></input>

                @error('name')
                <div class="text-red-500 mt-2 text-sm">
                    {{$message}}
                </div>
                @enderror
            </div>
            <div class="mb-4">
                <label for="email" class="sr-only">Email</label>
                <input name="email" id="email" cols="30" rows="4" class="bg-white border-2 w-full p-4 rounded-lg @error('email') border-red-500 @enderror" placeholder="Email" value="{{old('email')}}"></input>

                @error('email')
                <div class="text-red-500 mt-2 text-sm">
                    {{$message}}
                </div>
                @enderror
            </div>

            <div>
                <button type="submit" class="bg-blue-500 w-20 rounded-md text-white px-4 py-3 font-medium">Submit</button>
            </div>
        </form>
    </div> -->
</div>
@endsection