@extends('layouts.nonavlayout')

@section('content')

<div class="register-container">

   
    <form class="login" action="{{ route('user.authenticate')}}" method="POST">
     @csrf
     
     <a href="/"> <img src="{{ asset('/images/black-logo.png') }}"  ></a>
     <span class="title">Sign in</span>
     <span class="sub-title">to continue to Harticle</span>
 

     
       <div class="email">
          @error('email')
          <p class="error-msg">{{$message}}</p> 
          @enderror
          <input type="text" name="email" placeholder="Email">
       </div>
       
       <div class="password">
          @error('password')
          <p class="error-msg">{{$message}}</p> 
          @enderror
          <input type="password" name="password" placeholder="Password">
        </div>
     
 
       <div class="lower">
          <a class="sign-in-link" href="/register">Create account</a>
          <button type="submit">Sign in</button>
       </div>
     
    </form>
    
 </div>



@endsection