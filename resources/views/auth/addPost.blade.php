@extends('auth.home')

@section('content')
<div class="flex justify-center">
    <div class="w-8/12 bg-white p-6 rounded-lg mt-3 shadow-lg">
        <form action="{{route('addPost')}}" method="post" class="mb-4 mt-3" enctype="multipart/form-data">
            @csrf
            <div class="mb-4">
                <label for="body" class="sr-only">Body</label>
                <textarea name="body" id="body" cols="30" rows="4" class="bg-gray-100 border-2 w-full p-4 rounded-lg @error('body') border-red-500 @enderror" placeholder="Post something"></textarea>

                @error('body')
                <div class="text-red-500 mt-2 text-sm">
                    {{$message}}
                </div>
                @enderror
            </div>
            <div class="mb-4">
                <label for="image" class="sr-only">Image</label>
                <label class="w-64 flex flex-col items-center px-4 py-6 bg-white rounded-md shadow-md tracking-wide uppercase border border-blue cursor-pointer hover:bg-blue-500 hover:text-white text-blue-500 ease-linear transition-all duration-150">
                    <i class="fas fa-cloud-upload-alt fa-3x"></i>
                    <span class="mt-2 text-base leading-normal">Select a file</span>
                    <input type='file' class="hidden @error('image') border-red-500 @enderror" id="image" name="image" />

                </label>
                @error('image')
                <div class="text-red-500 mt-2 text-sm">
                    {{$message}}
                </div>
                @enderror
            </div>

            <div>
                <button type="submit" class="bg-blue-500 w-20 rounded-md text-white px-4 py-3 font-medium">Post</button>
            </div>
        </form>
        <p>{{auth()->user()->posts->count()}}</p>

    </div>
</div>

@endsection