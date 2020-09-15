<?php

namespace App\Traits;

trait AuthTrait
{
    public function signUp($fields)
    {
        $user = \App\User::create([
            'name'      => $fields->name,
            'email'     => $fields->email,
            'password'  => $fields->password
        ]);
        return $user;
    }

    public function signIn($fields)
    {
	    if (Auth::attempt($fields)) {
	        return redirect()->route('dashboard');
	    }
    }
}
