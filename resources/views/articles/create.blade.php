@extends('layouts.layout')

@section('content')


<div class="container-right">

    <form action="{{ route('article.store')}}" method="POST">
        @csrf

    @error('title')
       <p>{{$message}}</p> 
    @enderror
    <input type="text" name="title" placeholder="title"><br>
    @error('categories')
    <p>{{$message}}</p> 
    @enderror
    categorie <br>
    nature
    <input type="checkbox" name="categories[]" value="nature" ><br>
    technology
    <input type="checkbox" name="categories[]" value="technology" ><br>
    science
    <input type="checkbox" name="categories[]" value="science" ><br>
    comedy
    <input type="checkbox" name="categories[]" value="comedy" ><br>
    gaming
    <input type="checkbox" name="categories[]" value="gaming" ><br>
    @error('description')
    <p>{{$message}}</p> 
    @enderror
    <textarea name="description" placeholder="description"  cols="30" rows="10"></textarea>
    
    @error('image')
    <p>{{$message}}</p> 
    @enderror
    <input type="text" name="image" placeholder="image (just a link for now)"><br>
    
    <button type="submit">submit</button>
</form>

</div>

@endsection