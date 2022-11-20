{{-- @php
use Illuminate\Support\Arr;
@endphp --}}
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
        <div class="logo">
           <a href="/"> <img src="{{ asset('/images/logo.png') }}" width="150px" alt="logo"></a>
        </div>
        <form class="search-form" action="/" method="get">
            <input placeholder="Search" type="text" name="search" id="" class="search-bar">
            <button type="submit" class="search-btn"><i class="material-icons">search</i></button>
        </form>
    
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
    <div class="container">
        <div class="container-left">
            <div class="menu">
                <div class="tabs">
                    <a class="tab"  href="/"><i class="material-icons">home</i><p class="tab-name">Home</p></a>
                    <a class="tab"  href="/"><i class="material-icons">explore</i><p class="tab-name">Explore</p></a>
                    <a class="tab"  href="/"><i class="material-icons">star</i><p class="tab-name">New</p></a>
                    <a class="tab"  href="/"><i class="material-icons">groups</i><p class="tab-name">Following</p></a>
                </div>
                <div class="tabs">
                    @auth
                    <a class="tab"  href="/profile/{{Auth::user()->id}}"><i class="material-icons">article</i> <p class="tab-name">Your articles</p>  </a>
                    @else
                    <a class="tab"  href="/login"><i class="material-icons">article</i> <p class="tab-name">Your articles</p>  </a>
                    @endauth
                    <a class="tab"  href="/"><i class="material-icons">history</i><p class="tab-name">History</p></a>
                    <a class="tab"  href="/articles/read_later"><i class="material-icons">schedule</i><p class="tab-name">Read later</p></a>
                    <a class="tab"  href="/"><i class="material-icons">favorite</i><p class="tab-name">Favorite</p></a>
                </div>
            </div>
        </div>
    
    <div class="container-right">
        @yield('content')
    </div>
        
    </div>

</body>
</html>