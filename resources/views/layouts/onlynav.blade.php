<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{ url('/css/main.css') }}">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ Session::token() }}"> 
    <title>Document</title>
</head>
<body>
    <nav>
        {{-- website logo --}}
        <div class="logo">
            <a href="/"> <img src="{{ asset('/images/logo.png') }}" width="150px" alt="logo"></a>
        </div>
    
    {{-- search bar --}}
        <form class="search-form" action="/" method="get">
            <input placeholder="Search" type="text" name="search" id="" class="search-bar">
            <button type="submit" class="search-btn"><i class="material-icons">search</i></button>
        </form>
    
        {{-- icons and profile --}}
        <div class="nav-icons">
            @auth
            <a class="not-link" href="{{route('article.create')}}"><i class="material-icons">add</i></a>
                <form action="{{route('user.logout')}}" method="POST">
                    @csrf
                    <button class="sign-out-btn" type="submit"><i class="material-icons">logout</i></button>
                </form>
                <img class="mini-profile" src="{{Auth::user()->profile_picture ? Auth::user()->profile_picture: asset('/images/no-profile.jpg')}}" alt="">
                @else
                <a class="login-btn" href="{{route('user.login')}}">Sign in</a>
            @endauth   
         </div>
    </nav>
    @yield('content')
</body>
</html>