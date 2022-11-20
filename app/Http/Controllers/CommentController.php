<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\Comment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CommentController extends Controller
{
    // store a new comment
    public function store(Request $request, $id){
        $article = Article::findOrFail($id);
        $formFields = $request->validate([
            'comment_body' => 'required|max:256'
        ]);

        $formFields['article_id'] = $article->id;
        $formFields['user_id'] = Auth::user()->id;

        Comment::create($formFields);

        return back();
    }

    // update a comment
    public function update (Request $request, $id){
        // 
    }

    // delete a comment
    public function destroy($id){
        // 
    }
}
