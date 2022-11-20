<?php

namespace App\Models;

use App\Models\User;
use App\Models\Reply;
use App\Models\Article;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Comment extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 'article_id', 'comment_body']; 

    // a comment belongs to one article
    public function article(){
        return $this->belongsTo(Article::class);
    }

    // a comment belongs to one user
    public function user(){
        return $this->belongsTo(User::class);
    }

    // a comment has many replies
    public function replies(){
        return $this->hasMany(Reply::class);
    }
}
