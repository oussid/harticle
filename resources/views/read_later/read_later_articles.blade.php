@extends('layouts.layout')

@section('content')
    <div class="read-later-header">
        <div class="read-later-title">
            <h3 >Read Later</h3>
        </div>
        <div class="read-later-info">
            <div class="articles-count">
                <p>22 articles</p>
            </div>
        </div>
    </div>
    <div class="read-later-filter">
        <button class="sort-btn"><i class="material-icons">sort</i> Sort</button>
        <div id="select" class="filter-options">
            <div id="new" class="option">
                <p>Date added (newest)</p>
            </div>
            <div id="old" class="option">
                <p>Date added (oldest)</p>
            </div>
            <div id="popular" class="option">
                <p>Most popular</p>
            </div>
        </div>
    </div>
    <div class="articles read-later">
        @foreach ($articles as $article)
        <div class="article">
            @csrf
            
                <form action="/articles/read_later/{{$article->id}}" method="post">
                    @csrf
                    @method('DELETE')
                    <button class="read-later-btn"><i class="material-icons">delete</i></button>
                </form>
                  
            <a class="not-link" href="/articles/{{$article->id}}">
            <div class="img-area">
                <img width="200px" src="{{$article->image}}"> 
            </div>
            </a>
            <div class="description-area">
                <div class="publisher">
                    {{-- <a href="/profile/{{$article->user_id}}"><img class="mini-profile" width="50px" src="{{$article->user->profile_picture ? $article->user->profile_picture : asset('/images/no-profile.jpg')}}" alt=""></a> --}}
                </div>
                <div class="description">
                    <p class="desc-text">{{$article->title}}</p>
                    <p class="publisher-name">{{$article->user_first_name .' '.$article->user_last_name}}</p>
                    {{-- <p class="reads-counter">{{$article->readers->count()}} reads</p> --}}
                </div>
            </div>
        </div>
        @endforeach
    </div>    

<script >

let options = document.querySelectorAll('.option')

options.forEach(opt => {
    opt.addEventListener('click', ()=>{
        console.log(opt.id);
        window.location.href = '/articles/read_later?sort='+opt.id
    })
});

$('.sort-btn').click(()=>{
    $('.filter-options').fadeToggle("fast")
    
})

$(document).click(function() {
    var btn = $(".sort-btn");
    if (!btn.is(event.target)) {
        $('.filter-options').fadeOut('fast');
    }
});

                
</script>
@endsection