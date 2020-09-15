<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\User;

class Profile extends Model
{
    protected $fillable = [
    	'user_id',
    	'bio',
    	'location',
    	'photo',
    	'gender',
    	'age',
    	'cover_photo',
    	'job_title',
    	'twitter',
    	'facebook',
    	'instagram',
    	'dribble',
    ];

    public function user(User $user){
    	$this->belongsTo($user, 'id');
    }
}
