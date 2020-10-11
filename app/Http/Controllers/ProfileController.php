<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Profile;
use App\User;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\UpdateProfileRequest;
use Illuminate\Support\Facades\storage;

class ProfileController extends Controller
{
    public function index($username = null)
    {
        $user = User::where('username', $username)->with('profile')->first();
        return view('user.profile.index')->with(['user' => $user]);
    }

    public function create()
    {
    }

    public function edit()
    {
        $user_id = Auth::user()->id;
        $profile = Profile::where('user_id', $user_id)->first();
        return view('user.profile.edit')->with(['profile' => $profile]);
    }

    public function update(UpdateProfileRequest $request)
    {
        $user = auth()->user();
        $profile = Profile::where('user_id', $user->id)->first();
        $avatarPath = public_path('uploads/avatars/');
        $coverPath = public_path('uploads/covers/');
        
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


        if ($request->has('display_name')) {
            $user->display_name = $request->display_name;
            $user->save();
        }

        if ($request->hasFile('photo')) {
            if ($profile->photo &&  !(preg_match("/default/", $profile->photo))) {
                unlink($avatarPath . $profile->photo);
                $profile->photo = null;
                $profile->save();
            }

            $file = $request->file('photo');
            $name = $user->username . uniqid() . '.' . $file->extension();
            $file->storeAs('avatars', $name, 'public_uploads');
            $data['photo'] =  $name;
            //return $data;
        }

        if ($request->hasFile('cover_photo')) {
            if ($profile->cover_photo &&  !(preg_match("/default/", $profile->cover_photo))) {
                unlink($coverPath . $profile->cover_photo);
                $profile->cover_photo = null;
                $profile->save();
            }

            $file = $request->file('cover_photo');
            $name = $user->username . uniqid() . '.' . $file->extension();
            $file->storeAs('covers', $name, 'public_uploads');
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

    /**
     * Change the password
     *
     * @param  \App\Http\Requests\PasswordRequest  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function password(PasswordRequest $request)
    {
        auth()->user()->update(['password' => Hash::make($request->get('password'))]);
        return back()->withPasswordStatus(__('Password successfully updated.'));
    }
}
