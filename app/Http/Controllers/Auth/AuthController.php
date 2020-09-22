<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\User;
use App\Profile;
use App\Http\Requests\SignUpRequest;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class AuthController extends Controller
{
    public function signUp(SignUpRequest $request){

        if(isset($request->first_name) && isset($request->last_name)){
            $name = $request->first_name . ' ' . $request->last_name;
        }

    	$user = User::create([
    		'name' => $name,
            'username' => Str::slug($name, '-'),
            'display_name' => $request->display_name,
    		'email' => $request->email,
    		'password' => $request->password,
    	]);

        // assign a random cover photo between 1-10 
        $cover = 'default_cover' . rand(1, 10)  . '.jpg';

        if($request->gender == 'male'){
            $avatar = "default_avatar_male.jpg";
        }elseif ($request->gender == 'female') {
           $avatar = "default_avatar_female.jpg";
        }

    	Profile::create([
    		'user_id' => $user->id,
    		'gender' => $request->gender,
            'age' => $request->age,
            'location' => $request->location,
            'photo' => $avatar,
            'cover_photo' => $cover,
    	]);

    	if($user){
           auth()->loginUsingId($user->id);
        }
        
        return redirect()->route('index');
    }

    public function signIn(Request $request){
        $user = $request->only(['email', 'password']);

        $auth =  auth()->attempt($user);
        if($auth){
            return redirect()->route('index');
        }
        return redirect()->back();
    }
}
