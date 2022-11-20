@extends('layouts.nonavlayout')

@section('content')

<div class="register-container">

   
   <form class="register" action="{{ route('user.store')}}" method="POST">
    @csrf
    <a href="/"> <img src="{{ asset('/images/black-logo.png') }}"  ></a>
    <span class="title">Create your account</span>
    <span class="sub-title">to continue to Harticle</span>

      <div class="name">
        
            @error('first_name')
               <p class="error-msg">{{$message}}</p> 
            @enderror
            <input type="text" name="first_name" placeholder="First name">
        

         
            @error('last_name')
            <p class="error-msg">{{$message}}</p> 
         @enderror
         <input type="text" name="last_name" placeholder="Last name">
        
         
      </div>
    
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
         
         @error('password_confirmation')
         <p class="error-msg">{{$message}}</p> 
         @enderror
         <input type="password" name="password_confirmation" placeholder="Confirm password">
      </div>

      <div class="pictures">
         @error('profile_picture')
         <p class="error-msg">{{$message}}</p> 
         @enderror
         <input type="text" name="profile_picture" placeholder="Profile picture (link for now)">

      </div>
    

      <div class="lower">
         <a class="sign-in-link" href="/login">Sign in instead</a>
         <button type="submit">Sign up</button>
      </div>
    
   </form>
   
</div>

@endsection