@extends('layouts.layout')

@section('content')




    <header>
        <div class="banner">
            <img src="{{asset('/images/banner-placeholder.png')}}" alt="">
            <div class="social">

            </div>
        </div>
        <div class="publisher">
            <div class="profile">
                <div class="profile-left">
                    <img class="large-profile" width="50px" src="{{$user->profile_picture ? $user->profile_picture : asset('/images/no-profile.jpg')}}" alt="">
                </div>
                <div class="profile-right">
                    <p class="publisher-name">{{$user->first_name.' '.$user->last_name}}</p>
                    <p class="followers-counter">{{count($followers)}} follower{{count($followers)!=1 ? 's' : ''}}</p>
                </div>
            </div>
            {{-- check if the user is logged in  --}}
            <div class="buttons">
                @auth
                    {{-- check if current user is the owner of the profile --}}
                    @if ($user->id == Auth::user()->id)
                    <a class="not-link" href="#"><i class="material-icons">edit</i></a>
                
                @else
                    {{-- show UNFOLLOW button if user is already being followed by the current user --}}
                    @if ($followed_by_current_user)
                    
                        <form action="{{route('user.unfollow', ['id'=>$user->id])}}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="unfollow-btn">UNFOLLOW</button>
                        </form>
                    
                    {{-- show FOLLOW button if user is not being followed by the current user --}}
                    @else
                   
                        <form action="{{route('user.follow', ['id'=>$user->id])}}" method="POST">
                            @csrf
                            
                            <button type="submit" class="follow-btn">FOLLOW</button>
                        </form>
                   
                    
                    @endif
                    @endif
                    
                    {{-- redirect current user to login page if not logged in --}}
                    @else
                        <form action="/follow/{{$user->id}}" method="POST">
                            @csrf
                            
                            <button type="submit" class="follow-btn">FOLLOW</button>
                        </form>
                    @endauth
                </div>
                
                
            </header>
            {{-- navigation bar for the profile (ARTICLES, FOLLOWERS, FOLLOWING) --}}
            <div class="navigation-bar">
                <div id="articles" class="tab active">
                    <p>ARTICLES</p>
                </div>
                <div id="following" class="tab">
                    <p>FOLLOWING</p>
                </div>
                <div id="followers" class="tab">
                    <p>FOLLOWERS</p>
                </div>
            </div>        

    {{-- ARTICLES section --}}
    <div id="section-articles" class="articles profile section active">
        @foreach ($articles as $article)
        <a class="not-link" href="/articles/{{$article->id}}">
        <div class="article">
            <div class="img-area">
                <img width="200px" src="{{$article['image']}}">
            </div>
            <div class="description-area">
                <div class="publisher">
                    <img class="mini-profile" width="50px" src="{{$article->user->profile_picture ? $article->user->profile_picture : asset('/images/no-profile.jpg')}}" alt="profile">
                </div>
                <div class="description">
                    <p class="desc-text">{{$article->title}}</p>
                    <p class="publisher-name">{{$article->user->first_name .' '.$article->user->last_name}}</p>
                    <p class="reads-counter">{{$article->reads}} reads</p>
                </div>
            </div>
        </div>
        </a>
        @endforeach

    </div>

    {{-- FOLLOWING section --}}
    <div id="section-following" class="following section">
        @unless (count($following)!==0)
        <p>{{$user->first_name}} is not following anyone</p>
        @else
        @foreach ($following as $follow)
        <div class="user">
            <div class="profile-pic">
                <img class="xlarge-profile" src="{{$follow->profile_picture ? $follow->profile_picture : asset('/images/no-profile.jpg')}}" alt="">
            </div>
            <div class="user-name">
                <p>{{$follow->first_name.' '.$follow->last_name}}</p>
            </div>
            <div class="counter">
               <p>{{count($follow->followers)}} followers</p> 
            </div>
            <div class="buttons">
                {{-- if the user being followed is the current user then don't show button --}}
                @auth
                @if ($follow->id==Auth::user()->id)
                <div></div>
                
                
                
                {{-- the user being followed is not followed by current user --}}
                @elseif ($follow->followers->contains(Auth::user()->id))
                <form action="{{route('user.unfollow', ['id'=>$follow->id])}}" method="post">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="unfollow-btn">UNFOLLOW</button> 
                </form>
                @else
                    {{-- the user being followed is already followed by current user --}}
                    <form action="{{route('user.follow', ['id'=>$follow->id])}}" method="post">
                        @csrf
                        <button type="submit" class="follow-btn">FOLLOW</button> 
                    </form>
                @endif
                
                @else 
                <form action="{{route('user.login')}}" method="get">
                    @csrf
                    <button type="submit" class="follow-btn">FOLLOW</button> 
                </form>
                @endauth

                    
                    
            </div>
        </div>
            
        @endforeach
        @endunless
    </div>
    
    {{-- FOLLOWERS section  --}}
    <div id="section-followers" class="followers section">
        @unless (count($followers)!==0)
        <p>{{$user->first_name}} is not followed by anyone</p>
        @else
        @foreach ($followers as $follower)
        <div class="user">
            <div class="profile-pic">
                <img class="xlarge-profile" src="{{$follower->profile_picture ? $follower->profile_picture : asset('/images/no-profile.jpg')}}" alt="">
            </div>
            <div class="user-name">
                <p>{{$follower->first_name.' '.$follower->last_name}}</p>
            </div>
            <div class="counter">
               <p>{{count($follower->followers)}} followers</p> 
            </div>
            <div class="buttons">
                {{-- if the user being followed is the current user then don't show button --}}
                @auth
                @if ($follower->id==Auth::user()->id)
                <div></div>
                
                
                
                {{-- the user being followed is not followed by current user --}}
                @elseif ($follower->followers->contains(Auth::user()->id))
                <form action="{{route('user.unfollow', ['id'=>$follower->id])}}" method="post">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="unfollow-btn">UNFOLLOW</button> 
                </form>
                @else
                    {{-- the user being followed is already followed by current user --}}
                    <form action="{{route('user.follow', ['id'=>$follower->id])}}" method="post">
                        @csrf
                        <button type="submit" class="follow-btn">FOLLOW</button> 
                    </form>
                @endif
                
                @else 
                <form action="{{route('user.login')}}" method="get">
                    @csrf
                    <button type="submit" class="follow-btn">FOLLOW</button> 
                </form>
                @endauth

                    
                    
            </div>
            
        </div>
        @endforeach
        @endunless


<script src="{{url('/js/profile.js')}}"></script>
@endsection