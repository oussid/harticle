<?php

namespace App\Http\Controllers;

use App\Models\ReadLater;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class ReadLaterController extends Controller
{
    public function index(Request $request){
        if($request->get('sort') and $request->get('sort')=='new'){
          $articles = DB::table('articles')
            ->join('read_laters', 'articles.id', "=", 'read_laters.article_id')
            ->join('users', 'users.id', "=", 'articles.user_id')
            ->select('articles.*', 'users.first_name as user_first_name', 'users.last_name as user_last_name')
            ->orderBy('articles.created_at', 'DESC')
            ->get();
            // dd($articles);
            return view('read_later.read_later_articles', ['articles'=> $articles]);
            }


        if($request->get('sort') and $request->get('sort')=='old'){
            $articles = DB::table('articles')
            ->join('read_laters', 'articles.id', "=", 'read_laters.article_id')
            ->join('users', 'users.id', "=", 'articles.user_id')
            ->select('articles.*', 'users.first_name as user_first_name', 'users.last_name as user_last_name')
            ->orderBy('articles.created_at', 'ASC')
            ->get();
            // dd($articles);
            return view('read_later.read_later_articles', ['articles'=> $articles]);
        }

        // if($request->get('sort') and $request->get('sort')=='popular'){
        //     $articles = DB::table('articles')
        //     ->join('read_laters', 'articles.id', "=", 'read_laters.article_id')
        //     ->join('users', 'users.id', "=", 'articles.user_id')
        //     ->join('reads', 'reads.article_id', "=", 'articles.id')
        //     ->select('articles.*', 'users.first_name as user_first_name', 'users.last_name as user_last_name')
        //     // ->orderBy('articles.created_at', 'ASC')
        //     ->get();
        //     dd($articles);
        //     return view('read_later.read_later_articles', ['articles'=> $articles]);
        // }

        $articles = DB::table('articles')
                        ->join('read_laters', 'articles.id', "=", 'read_laters.article_id')
                        ->join('users', 'users.id', "=", 'articles.user_id')
                        ->select('articles.*', 'users.first_name as user_first_name', 'users.last_name as user_last_name')
                        ->get();
        return view('read_later.read_later_articles', ['articles'=> $articles]);
    }

    public function store(Request $request){
        $columns = [
            'user_id'=> Auth::user()->id,
            'article_id'=> $request->article_id
        ];
        ReadLater::create($columns);
        return back();
    }  
    
    public function destroy($article_id){
        // dd($article_id);
        $read_later = ReadLater::where('user_id','=', Auth::user()->id)->where('article_id','=', $article_id);
        $read_later->delete();
        return back();
    }
}
