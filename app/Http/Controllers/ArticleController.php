<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Article;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class ArticleController extends Controller
{
    public function index(Request $request){
        if($request->get('categorie')){
            return view('articles.index', ['articles'=> Article::latest()->where('categories', 'like', "%".$request->get('categorie')."%")->get()]);
        }
        if($request->get('search')){
            return view('articles.index', [
                'articles'=> Article::latest()->where('title', 'like', "%".$request->get('search')."%")
                ->orWhere('description', 'like', "%".$request->get('search')."%")
                ->get()
            ]);
        }
        return view('articles.index', ['articles'=> Article::latest()->get()]);
    }

    public function create(){
        return view('articles.create');
    }

    public function store(Request $request){
        $formFields = $request->validate([
            'title'=>'required',
            'description'=>'required',
            'categories'=>'required',
            'image'=> 'required'
        ]);

        $formFields['user_id'] = Auth::user()->id;

        Article::create($formFields);
        return redirect('/');
    }

    public function show($id){
        $article = Article::findOrFail($id);
        // dd(Auth::user()->comments->find(1)->replies);
        $likes = $article->likes;
        $liked_by_current_user = false;
        $followed_by_current_user = false;
        
        if(Auth::check()){
            // check if article is liked by current user
            foreach($likes as $like){
                if(Auth::user()->id == $like->user_id){
                    $liked_by_current_user = true;
                    break;
                }
            }
            // check if article owner is followed by current user 
                $followed_by_current_user = $article->user->followers->contains(Auth::user()->id);
            
            
            
            }
            
            // dd($article->readers);
        return view('articles.show', [
            'article' => $article,
            'following'=>$article->user->following,
            'followers'=>$article->user->followers,
            'likes'=> $likes,
            'reads'=> $article->reads,
            'followed_by_current_user' => $followed_by_current_user,
            'liked_by_current_user' => $liked_by_current_user
        ]);
    }
    
    public function edit($id){
        $article = Article::findOrFail($id);
        if($article->user_id!=Auth::user()->id){
            abort(403, 'Unauthorized action');
        }
        $article = Article::findOrFail($id);
        return view('articles.edit', ['article' => $article]);
    }
    
    public function update(Request $request, $id){
        $article = Article::findOrFail($id);
        // reaise a 403 if user is not the owner of the article 
        if($article->user_id!=Auth::user()->id){
            abort(403, 'Unauthorized action');
        }
        
        $formFields = $request->validate([
            'title'=>'required',
            'description'=>'required',
            'categories'=>'required',
            'image'=> 'required'
        ]);

        $article->update($formFields);
        return redirect('/');
    }

   

    public function delete($id){
        $article = Article::findOrFail($id);
        $article->delete();

        return redirect('/');
    }

}
