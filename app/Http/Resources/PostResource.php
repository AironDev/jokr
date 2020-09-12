<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use App\User;
use Illuminate\Support\Facades\Auth;
use App\Post;

class PostResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {   
        $user = User::where('id', $this->user_id)->with('profile:user_id,photo')->first();
        $auth_user = User::where('id', $request->auth_user_id)->first();

        $userReactionInterface = $auth_user->viaLoveReacter();
        

        $user = collect([
                    'id' => $user->id,
                    'photo' => $user->profile->photo,
                    'display_name' => $user->display_name,
                    'username' => $user->username
                ]);
        $postReactionInterface = $this->viaLoveReactant();
        $reactions = collect([
            'lol' => $postReactionInterface->getReactionCounterOfType('lol')->getCount(),
            'lwkmd' => $postReactionInterface->getReactionCounterOfType('lwkmd')->getCount(),
            'insidelife' => $postReactionInterface->getReactionCounterOfType('insidelife')->getCount(),
            'omo' => $postReactionInterface->getReactionCounterOfType('omo')->getCount(),
            'asin' => $postReactionInterface->getReactionCounterOfType('asin')->getCount(),
            'yfmh' => $postReactionInterface->getReactionCounterOfType('yfmh')->getCount(),
            'mtcheew' => $postReactionInterface->getReactionCounterOfType('mtcheew')->getCount(),
            'smh' => $postReactionInterface->getReactionCounterOfType('smh')->getCount(),
            'nfdl' => $postReactionInterface->getReactionCounterOfType('nfdl')->getCount(),
            'total' => $postReactionInterface->getReactionTotal()->getCount(),
            'points' => $postReactionInterface->getReactionTotal()->getWeight(),

        ]);


        $user_reactions = collect([
            'lol' => $userReactionInterface->hasReactedTo(Post::find($this->id), 'lol'),
            'lwkmd' =>  $userReactionInterface->hasReactedTo(Post::find($this->id), 'lwkmd'),
            'insidelife' =>  $userReactionInterface->hasReactedTo(Post::find($this->id), 'insidelife'),
            'omo' =>  $userReactionInterface->hasReactedTo(Post::find($this->id), 'omo'),
            'asin' =>  $userReactionInterface->hasReactedTo(Post::find($this->id), 'asin'),
            'yfmh' =>  $userReactionInterface->hasReactedTo(Post::find($this->id), 'yfmh'),
            'mtcheew' =>  $userReactionInterface->hasReactedTo(Post::find($this->id), 'mtcheew'),
            'smh' =>  $userReactionInterface->hasReactedTo(Post::find($this->id), 'smh'),
            'nfdl' =>  $userReactionInterface->hasReactedTo(Post::find($this->id), 'nfdl'),

        ]);

        return [
            'id' => $this->id,
            'content' => $this->content,
            'user_id' => $this->user_id,
            'privacy' =>  $this->privacy,
            'tags' => $this->tags,
            'is_published' => $this->is_published,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
            'user' => $user,
            'reactions' => $reactions,
            'user_reactions' => $user_reactions,
            
        ];
    }
}
