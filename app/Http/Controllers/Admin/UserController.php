<?php

namespace App\Http\Controllers\Admin;

use App\Post;
use App\User;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index()
    {
        return view('user.index');
    }


    public function edit($username)
    {
        $user = User::where('username', $username)->with('profile')->first();
        if ($user === null) {
            $user = auth()->user();
            //dd($user->profile->photo);
            return view('admin.users.edit')->with(['user' => $user]);
        }
        return view('admin.users.edit')->with(['user' => $user]);
    }
}
