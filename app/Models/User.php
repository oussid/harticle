<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use App\Models\Like;
use App\Models\Read;
use App\Models\Reply;
use App\Models\Article;
use App\Models\Follower;
use App\Models\ReadLater;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'first_name',
        'last_name',
        'email',
        'password',
        'profile_picture'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    // relationship with articles
    public function articles(){
        return $this->hasMany(Article::class);
    }

    // relationship with likes
    public function likes(){
        return $this->hasMany(Like::class);
    }

    // users that are following this user
    public function followers(){
        return $this->belongsToMany(User::class, 'followers', 'following_id', 'follower_id');
    }

    // users that this user is following
    public function following(){
        return $this->belongsToMany(User::class, 'followers', 'follower_id', 'following_id');
    }

    // user can read many articles
    public function reads(){
        return $this->hasMany(Read::class);
    }

    // a user has many comments
    public function comments(){
        return $this->hasMany(Comment::class);
    }
    
    // a user has many replies
    public function replies(){
        return $this->hasMany(Reply::class);
    }

    // a user can add many articles to read later
    public function read_laters(){
        return $this->hasMany(ReadLater::class);
    }
}
