<?php

namespace App\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Follower extends Model
{
    use HasFactory;

    protected $fillable = [
        'following_user_id',
        'followed_user_id',
        
    ];

    // relationship with user
    // public function users(){
    //     return $this->hasMany(User::class);
    // }
}
