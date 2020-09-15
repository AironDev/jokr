<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\User;
use App\Profile;
use App\Http\Requests\SignUpRequest;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    public function signUp(SignUpRequest $request){
    	$user = User::create([
    		'name' => $request->name,
    		'email' => $request->email,
    		'password' => $request->password,
    	]);

    	$profile = Profile::create([
    		'user_id' => $user->id,
    		'bio' => $request->bio
    	]);

    	return $user;
    }
}
