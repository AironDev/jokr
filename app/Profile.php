<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\User;

class Profile extends Model
{
    protected $guarded = ['id'];

    public function user(User $user){
    	$this->belongsTo($user, 'id');
    }
}
