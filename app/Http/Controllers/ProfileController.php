<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Profile;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\UpdateProfileRequest;
use Illuminate\Support\Facades\storage;

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
    	$avatarPath = '/public/avatars';
    	$coverPath = '/public/covers';
    	
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


    	if($request->has('display_name')){
    		$user->display_name = $request->display_name;
    		$user->save();
    	}

    	if($request->hasFile('photo')){

    		if($profile->photo){
    			Storage::delete($avatarPath . '/' . $profile->photo);
    			$profile->photo = null;
    			$profile->save();
    		}

    		$file = $request->file('photo');
    		$name = $user->username . uniqid() . '.' . $file->extension();
    		$file->storePubliclyAs($avatarPath, $name);
    		$data['photo'] =  $name;
    		//return $data;
    	}

    	if($request->hasFile('cover_photo')){

    		if($profile->cover_photo){
    			Storage::delete($coverPath . '/' . $profile->cover_photo);
    			$profile->cover_photo = null;
    			$profile->save();
    		}

    		$file = $request->file('cover_photo');
    		$name = $user->username . uniqid() . '.' . $file->extension();
    		$path = '/public/covers';
    		$file->storePubliclyAs($path, $name);
    		$data['cover_photo'] =  $name;
    		//return $data;
    	}

    	$profile->update($data);
    	//dd($profile);
    	return redirect()->back();
    }


    public function store()
    {

    }

    public function destroy()
    {

    }
}
