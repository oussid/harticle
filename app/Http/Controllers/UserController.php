<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class userController extends Controller
{
    public function create(){
        return view('users.register');
    }

    public function store(Request $request){
        $formFields = $request->validate([
            'first_name' => 'required|min:3|max:24',
            'last_name' => 'required|min:3|max:24',
            'email' => ['required', 'email', Rule::unique('users', 'email')],
            'password' => 'required|confirmed|min:3|max:24|regex:/^(?=.*[A-Za-z])(?=.*\d)[A-Za-z\d]{8,}$/'
        ]);

        $formFields['password'] = bcrypt($formFields['password']);

        if($request->filled('profile_picture')){
            $formFields['profile_picture'] = $request->get('profile_picture') ;
        }

        $user = User::create($formFields);
        Auth::login($user);
        $request->session()->regenerate();

        return redirect('/');
    }

    public function login(){
        return view('users.login');
    }

    public function authenticate(Request $request){
        $formFields = $request->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);

        

        if(Auth::attempt($formFields)){
            $request->session()->regenerate();
            return redirect('/');
        }

        return back();
    }

    public function logout(Request $request){
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/');
    }

    public function profile($id){
        $user = User::findOrFail($id);
        $followed_by_current_user = false;
        
        if(Auth::check()){
            $followed_by_current_user = $user->followers->contains(Auth::user()->id);
        }
        
        
        return view('users.profile', [
            'user'=>$user,
            'articles'=>$user->articles,
            'following'=>$user->following,
            'followers'=>$user->followers,
            'followed_by_current_user' => $followed_by_current_user
        ]);
    }

    public function follow($id){
        // get the user to follow
        $user = User::findOrFail($id);

        // make sure user is NOT being followed by current user
        if($user->followers->contains(Auth::user()->id)){
            return back();
        }

        // follow user
        Auth::user()->following()->attach($user);
        return back();
    }
    
    public function unfollow($id){
        // get the user to unfollow
        $user = User::findOrFail($id);

        // make sure user is followed by current user
        if(!$user->followers->contains(Auth::user()->id)){
            return back();
        }

        // unfollow user
        Auth::user()->following()->detach($user);
        return back();
    }
}
