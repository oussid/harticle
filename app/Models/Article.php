<?php

namespace App\Models;

use App\Models\Like;
use App\Models\Read;
use App\Models\Comment;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;


class Article extends Model
{
    use HasFactory;
    protected $fillable = ['title', 'user_id', 'description', 'reads', 'likes', 'categories', 'image'];
    protected $casts = ['categories' => 'array'];
    
    // relationship with users
    public function user(){
        return $this->belongsTo(User::class);
    }
    
    // relationship with likes
    public function likes(){
        return $this->hasMany(Like::class);
    }

    // article can be read by many users
    public function reads(){
        return $this->hasMany(Read::class);
    }

    // an article has many comments
    public function comments(){
        return $this->hasMany(Comment::class);
    }



}
