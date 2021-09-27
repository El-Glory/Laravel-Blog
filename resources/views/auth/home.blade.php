<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Panel Laravel Blog</title>
    <link rel="stylesheet" href="{{asset('css/app.css')}}">
    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous" />
    <link href="https://cdn.jsdelivr.net/npm/@tailwindcss/custom-forms@0.2.1/dist/custom-forms.css" rel="stylesheet">


</head>

<body class="bg-gray-100">
    <nav class="flex p-4 bg-white justify-between mb-3">
        <ul class="flex items-center">
            <li>
                <a href="{{route('dashboard')}}" class="p-3">Dashboard</a>
            </li>
            <li>
                <a href="{{route('addPost')}}" class="p-3">Add Post</a>
            </li>

        </ul>

        <ul class="flex items-center">
            <li>
                <a href="" class="p-3">{{auth()->user()->name}}</a>
            </li>

            <li>
                <form action="{{route('logout')}}" method="post" class="inline p-3">
                    @csrf
                    <button type="submit">Logout</button>
                </form>
            </li>
        </ul>
    </nav>
    <div class="flex justify-center">
        <div class="bg-blue-300 rounded-lg shadow-lg flex justify-center w-4/12 p-4">
            <p>Welcome {{auth()->user()->name}}</p>
        </div>
    </div>

    @yield('content')
</body>

</html>