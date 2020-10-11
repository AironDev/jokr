<?php

namespace App\Http\Controllers;

use App\Post;
use App\User;

use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index()
    {
        return view('user.index');
    }

    public function friends()
    {
        return view('user.friends');
    }

    public function about()
    {
        return view('user.about');
    }

    public function photos()
    {
        return view('user.photos');
    }

    public function signup()
    {
        return view('auth.signup');
    }

    public function signin()
    {
        return view('auth.signin');
    }
}
