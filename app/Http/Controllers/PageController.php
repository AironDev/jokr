<?php

namespace App\Http\Controllers;
use App\Post;
use App\User;

use Illuminate\Http\Request;

class PageController extends Controller
{
    public function index(){
    	return view('index');
    }

    public function friends(){
    	return view('friends');
    }

    public function about(){
    	return view('about');
    }

    public function photos(){
    	return view('photos');
    }

    public function signup(){
        return view('auth.signup');
    }

    public function profile($username = null){
        $user = User::where('username', $username)->with('profile')->first();
    	return view('profile')->with(['user' => $user]);
    }
}
