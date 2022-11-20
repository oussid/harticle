@extends('layouts.onlynav')

@section('content')

{{-- LEFT PART  --}}
<div class="show-container">
    <div class="left">
        <div class="icons">
            <div class="likes">
                @if ($liked_by_current_user)
                <form action="{{route('like.destroy', $article->id)}}" method="POST">
                    @csrf
                    @method('DELETE')
                    <button type="submit"><i class="material-icons">favorite</i></button>
                </form>
                @else
                <form action="/like/{{$article->id}}" method="POST">
                    @csrf
                    <button type="submit"><i class="material-icons">favorite_border</i></button>
                </form>
                @endif
                
                <p>{{count($likes)}}</p>   
            </div>
            <div class="likes">
                <i class="material-icons">comment</i>
                <p>{{count($article->comments)}}</p>
            </div>
            <div class="likes">
                <i class="material-icons">visibility</i>
                <p>{{count($reads)}}</p>
            </div>
            
            
        </div>
    </div>
    

{{-- CENTER PART  --}}
    <div id="{{$article->id}}" class="center">
        <div class="banner">
            <img src="{{$article->image}}" alt="">
        </div>

        <div class="center-upper">
            <div class="upper-left">
                <img class="medium-profile" src="{{$article->user->profile_picture ? $article->user->profile_picture : asset('/images/no-profile.jpg')}}" alt="">
            </div>
            <div class="upper-right">
                <p class="name"> {{$article->user->first_name.' '.$article->user->last_name}}</p>
                <p class="date">Posted on {{$article->created_at->format('Y-m-d')}}</p>
            </div>
        </div>

        <div class="center-body">
            <h1 class="title">{{$article->title}}</h1>
            <div class="categories"> 
                @foreach ($article->categories as $categorie)
                    <a class="categorie" href="#">{{$categorie}}</a>
                @endforeach
            </div>

            <div class="center-text">
                <p>
                    {{$article->description}}
                </p>
            </div> 
            
            <div class="comments-section">
                <div class="comments-upper">
                    <h2>Comments</h2>
                    <form class="comments-form" action="{{route('comment.store', ['id'=>$article->id])}}" method="POST">
                        @csrf
                        <div class="comment-wrapper">
                            <div class="img">
                                @auth
                                <img class="mini-profile" src="{{Auth::user()->profile_picture ? Auth::user()->profile_picture : asset('/images/no-profile.jpg')}}" alt="">
                                @else
                                <img class="mini-profile" src="{{ asset('/images/no-profile.jpg')}}" alt="">

                                @endauth
                            </div>
                        <textarea name="comment_body" id="" cols="60" rows="2" placeholder="Add to the discussion"></textarea>
                        </div>
                        <div class="buttons">
                            <button type="submit">Comment</button>
                        </div>
                    </form>
                </div>
                {{-- comments --}}
                <div class="comments">
                    @foreach ($article->comments->sortDesc() as $comment)
                    <div class="comment" >
                        <div class="wrapper">
                            <div class="img">
                                <img class="mini-profile" src="{{$comment->user->profile_picture ? $comment->user->profile_picture : asset('/images/no-profile.jpg')}}" alt="">
                            </div>
                            <div class="comment-body">
                                <div class="upper">
                                    <h3 class="commenter">{{$comment->user->first_name.' '.$comment->user->last_name}}</h3>
                                    <p class="date">{{$comment->created_at->format('Y-m-d');}}</p>
                                </div>
                                <p>{{$comment->comment_body}}</p>
                            </div> 
                        </div>
                        
                        <div class="comment-buttons">
                            <button id="{{$comment->id}}" class="reply-btn">Reply</button>
                        </div>
                        {{-- write a reply --}}
                    <form class="reply-section" id="reply-section{{$comment->id}}" action="{{route('reply.store', ['id'=>$comment->id])}}" method="POST"  >
                        @csrf
                        <textarea name="reply_body" placeholder="Add a reply..."  cols="60" rows="3"></textarea>
                        <div class="reply-buttons">
                            <button id="{{$comment->id}}" class="cancel">Cancel</button>
                            <button type="submit" class="reply">Reply</button>
                        </div>
                    </form>
        
                        {{-- comment replies --}}
                        @foreach ($comment->replies->sortDesc() as $reply)
                        <div class="replies">
                            <div class="reply">
                                <div class="img">
                                    <img class="mini-profile" src="{{$reply->user->profile_picture ? $reply->user->profile_picture : asset('/images/no-profile.jpg')}}" alt="">
                                </div>
                                <div class="reply-text">
                                    <div class="upper">
                                        <h3 class="replyer-name">{{$reply->user->first_name.' '.$reply->user->last_name}}</h3>
                                        <p class="date">{{$reply->created_at->format('Y-m-d');}}</p>
                                    </div>
                                    <p>{{$reply->reply_body}}</p>
                                </div>
                            </div>
                        </div>
                            
                        @endforeach
        
                    </div>
                        
                    @endforeach
        
                    
                </div>
            </div>
        </div>
        
    </div>

{{-- RIGHT PART  --}}
    <div class="right">
        <div class="right-wrapper">
            <div class="publisher-info">
                <div class="upper">
                    <div class="banner">
    
                    </div>
                    <div class="profile-img">
                        <img class="medium-profile" width="50px" src="{{$article->user->profile_picture ? $article->user->profile_picture : asset('/images/no-profile.jpg')}}" alt="">
                        <p>{{$article->user->first_name .' '.$article->user->last_name}}</p>
                    </div>
                </div>
    
                <div class="body">
                    {{-- <div class="buttons">
                        <button>Follow</button>
                    </div> --}}
                    <div class="buttons">
                        @auth
                            {{-- check if current user is the owner of the article --}}
                            @if ($article->user->id == Auth::user()->id)
                            <span></span>
                        
                        @else
                            {{-- show UNFOLLOW button if user is already being followed by the current user --}}
                            @if ($followed_by_current_user)
                                <form action="{{route('user.unfollow', ['id'=>$article->user->id])}}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="unfollow-btn">UNFOLLOW</button>
                                </form>
                            
                            {{-- show FOLLOW button if user is not being followed by the current user --}}
                            @else
                                <form action="{{route('user.follow', ['id'=>$article->user->id])}}" method="POST">
                                    @csrf
                                    <button type="submit" class="follow-btn">FOLLOW</button>
                                </form>
                           
                            
                            @endif
                            @endif
                            
                            {{-- redirect current user to login page if not logged in --}}
                            @else
                                <form action="{{route('user.follow', ['id'=>$article->user->id])}}" method="POST">
                                    @csrf
                                    <button type="submit" class="follow-btn">FOLLOW</button>
                                </form>
                            @endauth
                        </div>
                    <div class="about">
                        <p>Lorem ipsum jsldf osdlfk qmmoi dklsf  </p>
                    </div>
                </div>
            </div>
    
            <div class="read-next">
                <div class="upper">
                    <h2>Read next</h2>
                </div>
                <div class="v-articles">
                    <div class="article">
                    
                        <a class="not-link" href="/articles/{{$article->id}}">
                        <div class="img-area">
                            <img  src="{{$article['image']}}"> 
                        </div>
                        </a>
                        <div class="description-area">
                            <div class="publisher">
                                <a href="/profile/{{$article->user->id}}"><img class="mini-profile" width="50px" src="{{$article->user->profile_picture ? $article->user->profile_picture : asset('/images/no-profile.jpg')}}" alt=""></a>
                            </div>
                            <div class="description">
                                <p class="desc-text">{{$article->title}}</p>
                                <p class="publisher-name">{{$article->user->first_name .' '.$article->user->last_name}}</p>
                                <p class="reads-counter">{{$article->reads}} reads</p>
                            </div>
                        </div>
                    </div>
                    <div class="article">
                    
                        <a class="not-link" href="/articles/{{$article->id}}">
                        <div class="img-area">
                            <img  src="{{$article['image']}}"> 
                        </div>
                        </a>
                        <div class="description-area">
                            <div class="publisher">
                                <a href="/profile/{{$article->user->id}}"><img class="mini-profile" width="50px" src="{{$article->user->profile_picture ? $article->user->profile_picture : asset('/images/no-profile.jpg')}}" alt=""></a>
                            </div>
                            <div class="description">
                                <p class="desc-text">{{$article->title}}</p>
                                <p class="publisher-name">{{$article->user->first_name .' '.$article->user->last_name}}</p>
                                <p class="reads-counter">{{$article->reads}} reads</p>
                            </div>
                        </div>
                    </div>
                    <div class="article">
                    
                        <a class="not-link" href="/articles/{{$article->id}}">
                        <div class="img-area">
                            <img  src="{{$article['image']}}"> 
                        </div>
                        </a>
                        <div class="description-area">
                            <div class="publisher">
                                <a href="/profile/{{$article->user->id}}"><img class="mini-profile" width="50px" src="{{$article->user->profile_picture ? $article->user->profile_picture : asset('/images/no-profile.jpg')}}" alt=""></a>
                            </div>
                            <div class="description">
                                <p class="desc-text">{{$article->title}}</p>
                                <p class="publisher-name">{{$article->user->first_name .' '.$article->user->last_name}}</p>
                                <p class="reads-counter">{{$article->reads}} reads</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
       
    </div>
</div>

{{-- user reading article has to be authenticated to increment reads --}}
@auth   
<script type="text/javascript">
$(document).ready(function(){
    let id = $('.center').attr('id')
 
     $.ajaxSetup({
         headers: {
             'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
         }
     });
     
     
     $.ajax({
         type:'POST',
         url:"/articles/read/"+id,
         success:function(data){
                 console.log('request sent successfully');;
             },
         error: function (err){
             console.log('something went wrong: ', err)
         }
     });
 
});
            
</script>




@endauth


<script type="text/javascript">
$(document).ready(function(){
  $(".reply-btn").click(function(){
    $('#reply-section'+$(this).attr('id')).slideToggle("slow");
  });

  $(".cancel").click(function(e){
    e.preventDefault();
    $('#reply-section'+$(this).attr('id')).slideUp("slow");
  });
});
</script>




@endsection
















{{-- <img src="{{$article->image}}" Hello world />
<h2>{{$article->title}}</h2>
<p>{{$article->description}}</p>
<ul>
    @foreach ($article->categories as $categorie)
        <li>{{$categorie}}</li>
    @endforeach
</ul>

<button> <a href="/articles/edit/{{$article->id}}">edit</a> </button>
<form action="/articles/{{$article->id}}" method="POST">
    @csrf
    @method('DELETE')
    <button >delete</button>
</form> --}}