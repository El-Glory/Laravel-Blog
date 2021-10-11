<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laravel Blog</title>
    <link rel="stylesheet" href="{{asset('css/app.css')}}">
</head>

<body class="bg-gray-100 mt-10">
    <div class="flex justify-center">
        <div class="w-4/12 bg-white rounded-lg shadow-lg">
            @if (session('status'))
            <div class="bg-red-500 p-4 rounded-lg mb-3 text-white text-center">
                {{session('status')}}
            </div>

            @endif

            <form action="{{route('register')}}" method="POST" class="items-center p-6">
                @csrf
                <div class="mb-4">
                    <label for="name" class="sr-only">Name</label>
                    <input type="text" name="name" id="name" placeholder="Your name" class="bg-gray-100 rounded-md border-2 w-11/12  p-4 @error('name') border-red-500 @enderror" value="{{old('name')}}">

                    @error('name')
                    <div class="text-red-500 text-sm mt-2 text-center">
                        {{$message}}
                    </div>

                    @enderror
                </div>
                <div class="mb-4">
                    <label for="email" class="sr-only">Email Address</label>
                    <input type="text" name="email" id="email" placeholder="Your Email Address" class="bg-gray-100 border-2 w-11/12 p-4 rounded-md @error('email') border-red-500 @enderror" value="{{old('email')}}">

                    @error('email')
                    <div class="text-red-500 text-sm mt-2 text-center">
                        {{$message}}
                    </div>

                    @enderror
                </div>

                <div class="mb-4">
                    <label for="password" class="sr-only">Password</label>
                    <input type="password" name="password" id="password" placeholder="Choose a  password" class="bg-gray-100 border-2 w-11/12 p-4 rounded-md @error('password') border-red-500 @enderror" value="">

                    @error('password')
                    <div class="text-red-500 text-sm mt-2 text-center">
                        {{$message}}
                    </div>

                    @enderror
                </div>

                <div class="mb-4">
                    <label for="password_confirmation" class="sr-only">Confirm Password</label>
                    <input type="password" name="password_confirmation" id="password" placeholder="Confirm password" class="bg-gray-100 border-2 w-11/12 p-4 rounded-md @error('password_confirmation') border-red-500 @enderror" value="">

                    @error('password_confirmation')
                    <div class="text-red-500 text-sm mt-2 text-center">
                        {{$message}}
                    </div>

                    @enderror
                </div>

                <div>
                    <button type="submit" class="bg-blue-500 w-11/12 rounded-md text-white px-4 py-3 font-medium">Submit</button>
                </div>
            </form>
        </div>
    </div>


</body>

</html>