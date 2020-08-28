<?php

namespace App\Http\Controllers;
use App\Post;

use Illuminate\Http\Request;

class PageController extends Controller
{
    public function index(){
        $posts = Post::all();
    	return view('index')->with(['posts' => $posts]);
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

    public function profile(){
    	return view('profile');
    }
}
