<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laravel Blog</title>
    <link rel="stylesheet" href="{{asset('css/app.css')}}">
</head>

<body class="bg-white">
    <nav class="flex p-3 bg-gray-100 justify-between sticky top-0 z-50 shadow-lg mt-2">
        <ul class="flex items-center ">
            <li>
                <a href="" class="p-3 relative">HOME</a>
            </li>
        </ul>
        @guest
        <ul class="flex items-center">
            <li>
                <a href="{{route('register')}}" class="p-3">REGISTER</a>
            </li>
            <li>
                <a href="{{route('login')}}" class="p-3">LOGIN</a>
            </li>

        </ul>
        @endguest
    </nav>
    @yield('content')
</body>

</html>