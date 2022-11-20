@extends('layouts.layout')

@section('content')

<div class="header">
    <div class="categories">
        <a href="/" class="categorie">All</a>
        <a href="/?categorie=sport" class="categorie">Sport</a>
        <a href="/?categorie=science" class="categorie">Science</a>
        <a href="/?categorie=technology" class="categorie">Technology</a>
        <a href="/?categorie=cinema" class="categorie">Cinema</a>
        <a href="/?categorie=gaming" class="categorie">Gaming</a>
        <a href="/?categorie=fitness" class="categorie">Fitness</a>
        <a href="/?categorie=programming" class="categorie">Computer programming</a>
        <a href="/?categorie=comedy" class="categorie">Comedy</a>
        <a href="/?categorie=health" class="categorie">Health</a>
        <a href="/?categorie=animals" class="categorie">Animals</a>
    </div>
</div>

<div class="articles">
    @foreach ($articles as $article)
    <div class="article">
        @csrf
        {{-- if user is logged in  --}}
        @auth
        {{-- if user has already added this article to read later --}}
            @if (Auth::user()->read_laters->where('article_id',$article->id)->count()>0 )
            <form action="/articles/read_later/{{$article->id}}" method="post">
                @csrf
                @method('DELETE')
                <button class="read-later-btn"><i class="material-icons">done</i></button>
            </form>
                {{-- if user has not yet added this article to read later --}}
                @else
                <form action="{{route('readlater.store', ['article_id'=>$article->id])}}" method="post">
                    @csrf
                    <button class="read-later-btn"><i class="material-icons">schedule</i></button>
                </form>
                @endif
            {{-- if user is not logged in --}}
            @else
            <form action="{{route('readlater.store', ['article_id'=>$article->id])}}" method="post">
                @csrf
                <button class="read-later-btn"><i class="material-icons">schedule</i></button>
            </form>
            @endauth
        <a class="not-link" href="/articles/{{$article->id}}">
        <div class="img-area">
            <img width="200px" src="{{$article['image']}}"> 
        </div>
        </a>
        <div class="description-area">
            <div class="publisher">
                <a href="/profile/{{$article->user->id}}"><img class="mini-profile" width="50px" src="{{$article->user->profile_picture ? $article->user->profile_picture : asset('/images/no-profile.jpg')}}" alt=""></a>
            </div>
            <div class="description">
                <p class="desc-text">{{$article->title}}</p>
                <p class="publisher-name">{{$article->user->first_name .' '.$article->user->last_name}}</p>
                <p class="reads-counter">{{$article->reads->count()}} reads</p>
            </div>
        </div>
    </div>
    @endforeach
</div>    
@endsection

