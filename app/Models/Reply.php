<?php

namespace App\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Reply extends Model
{
    use HasFactory;

    protected $fillable = ['comment_id', 'user_id', 'reply_body'];

    // a reply belongs to one user
    public function user (){
        return $this->belongsTo(User::class);
    }

    // a reply belongs to one comment
    public function comment (){
        return $this->belongsTo(User::class);
    }
}
