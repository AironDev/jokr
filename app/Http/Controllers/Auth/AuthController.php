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

        if($request->gender == 'male'){
            $avatar = "/uploads/avatar/default_avatar_male.jpg";
        }elseif ($request->gender == 'female') {
           $avatar = "/uploads/avatar/default_avatar_female1.jpg";
        }

    	$profile = Profile::create([
    		'user_id' => $user->id,
    		'gender' => $request->bio,
            'age' => $request->bio,
            'location' => $request->bio,
            'photo' => $avatar,
    	]);
    	return Auth::attempt($user);
    }
}