<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laravel Blog</title>
    <link rel="stylesheet" href="{{asset('css/app.css')}}">
</head>

<body class="bg-gray-100">
    <nav class="flex p-4 bg-white justify-center">
        <ul class="flex items-center">
            <li>
                <a href="" class="p-3">HOME</a>
            </li>
        </ul>
        <ul class="flex items-center">
            <!-- <li>
                <a href="" class="p-3">Login</a>
            </li>
            <li>
                <a href="" class="p-3">Logout</a>
            </li> -->

        </ul>
    </nav>
    @yield('content')
</body>

</html>