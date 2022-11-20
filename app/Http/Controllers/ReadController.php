<?php

namespace App\Http\Controllers;

use App\Models\Read;
use App\Models\Article;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ReadController extends Controller
{
     // increment reads
     public function store($id){
        $article = Article::findOrFail($id);
        $read_by_current_user = false;
        
        // check if user already read article
        foreach($article->reads as $read){
            if($read->user->id == Auth::user()->id){
                $read_by_current_user= true;
                break;
            }
        }

        // don't increment reads if current user has already read the article
        if($read_by_current_user==false) {
            Read::create(['article_id'=>$article->id, 'user_id'=>Auth::user()->id]);
        }
    }
}
