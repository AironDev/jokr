<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Profile;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\UpdateProfileRequest;

class ProfileController extends Controller
{
    public function index()
    {

    }

    public function create()
    {

    }

    public function edit()
    {
    	$user_id = Auth::user()->id;
    	$profile = Profile::where('user_id', $user_id)->first();
    	return view('profile.edit')->with(['profile' => $profile]);
    }

    public function update(UpdateProfileRequest $request)
    {	
    	$user = auth()->user();
    	$profile = Profile::where('user_id', $user->id)->first();
    	
    	$data = $request->only([
    		'bio',
    		'location',
    		'job_title',
    		'gender',
    		'age', 
    		'facebook', 
    		'twitter', 
    		'linkedin', 
    		'instagram'
    	]);

    	$user = auth()->user();
    	if($request->has('display_name')){
    		$user->display_name = $request->display_name;
    		$user->save();
    	}

    	if($request->hasFile('photo')){
    		$file = $request->file('photo');
    		$name = $user->username . uniqid() . '.' . $file->extension();
    		$path = '/public/avatar/';
    		$file->storePubliclyAs($path, $name);
    		$data['photo'] =  $name;
    	}

    	if($request->hasFile('cover_photo')){
    		$file = $request->file('cover_photo');
    		$name = $user->username . uniqid() . '.' . $file->extension();
    		$path = '/public/cover/';
    		$file->storePubliclyAs($path, $name);
    		$data['photo'] =  $name;
    	}

    	$profile->update($data);
    	dd($profile);
    }

    public function store()
    {

    }

    public function destroy()
    {

    }
}
