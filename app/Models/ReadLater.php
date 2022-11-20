<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ReadLater extends Model
{
    use HasFactory;
    protected $fillable = ['user_id', 'article_id'];

    // a read later article is read by 1 user
    public function user(){
        return $this->belongsTo(User::class);
    }

}
