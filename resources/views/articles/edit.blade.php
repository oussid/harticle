@php
    use Illuminate\Support\Arr;
@endphp

@extends('layouts.layout')

@section('content')
<form action="/articles/{{$article->id}}'" method="POST">
    @csrf
    @method('PUT')

    @error('title')
       <p>{{$message}}</p> 
    @enderror
    <input type="text" name="title" value="{{$article->title}}"><br>
    @error('categories')
    <p>{{$message}}</p> 
    @enderror
    categorie <br>
    nature
    <input type="checkbox" name="categories[]" value="nature" {{in_array('nature', $article->categories )  ? 'checked' : ''}}><br>
    technology
    <input type="checkbox" name="categories[]" value="technology" {{in_array('technology', $article->categories )  ? 'checked' : ''}}><br>
    science
    <input type="checkbox" name="categories[]" value="science" {{in_array('science', $article->categories )  ? 'checked' : ''}}><br>
    comedy
    <input type="checkbox" name="categories[]" value="comedy" {{in_array('comedy', $article->categories )  ? 'checked' : ''}}><br>
    gaming
    <input type="checkbox" name="categories[]" value="gaming" {{in_array('gaming', $article->categories )  ? 'checked' : ''}}><br>
    @error('description')
    <p>{{$message}}</p> 
    @enderror
    <textarea name="description"  cols="30" rows="10">{{$article->description}}</textarea>
    
    @error('image')
    <p>{{$message}}</p> 
    @enderror
    <input type="text" name="image" value="{{$article->image}}"><br>
    
    <button type="submit">submit</button>
</form>

@endsection


