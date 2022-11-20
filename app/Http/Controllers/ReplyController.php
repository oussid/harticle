<?php

namespace App\Http\Controllers;

use App\Models\Reply;
use App\Models\Comment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ReplyController extends Controller
{
    // store a new reply
    public function store(Request $request, $id){
        $comment = Comment::findOrFail($id);
        $formFields = $request->validate([
            'reply_body' => 'required|max:256'
        ]);

        
        $formFields['comment_id'] = $comment->id;
        $formFields['user_id'] = Auth::user()->id;

        Reply::create($formFields);

        return back();
    }

    // update a reply
    public function update (Request $request, $id){
        // 
    }

    // delete a reply
    public function destroy($id){
        // 
    }
}
