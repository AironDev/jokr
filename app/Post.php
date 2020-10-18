<?php

namespace App;

use Cog\Contracts\Love\Reactable\Models\Reactable as ReactableContract;
use Cog\Laravel\Love\Reactable\Models\Traits\Reactable;

use Illuminate\Database\Eloquent\Model;

class Post extends Model implements ReactableContract
{
	use Reactable;
    protected $guarded = [
    	'id'
    ];

    public function user(){
        return $this->belongsTo('App\User', 'user_id');
    }

    public function comments(){
    	return $this->hasMany('App\Comment', 'post_id');
    }

    public function owner(){
        $owner = User::where('id', $this->user_id)->first();
        return $owner;
    }
}
