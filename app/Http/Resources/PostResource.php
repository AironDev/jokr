<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use App\User;
use Illuminate\Support\Facades\Auth;

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
        $user = collect([
                    'id' => $user->id,
                    'photo' => $user->profile->photo,
                    'display_name' => $user->display_name,
                    'username' => $user->username
                ]);
        $postReactionInterface = $this->viaLoveReactant();
        $reactions = collect([
            'funny' => $postReactionInterface->getReactionCounterOfType('funny')->getCount(),
            'not_funny' => $postReactionInterface->getReactionCounterOfType('notfunny')->getCount(),
            'madoh' => $postReactionInterface->getReactionCounterOfType('madoh')->getCount(),
            'asin' => $postReactionInterface->getReactionCounterOfType('asin')->getCount(),
            'smh' => $postReactionInterface->getReactionCounterOfType('smh')->getCount(),
            'swears' => $postReactionInterface->getReactionCounterOfType('swears')->getCount(),
            'na-so' => $postReactionInterface->getReactionCounterOfType('naso')->getCount(),
            'omo' => $postReactionInterface->getReactionCounterOfType('omo')->getCount(),
            'abi-na' => $postReactionInterface->getReactionCounterOfType('abina')->getCount(),
            'total' => $postReactionInterface->getReactionTotal()->getCount(),
            'points' => $postReactionInterface->getReactionTotal()->getWeight(),

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
            
        ];
    }
}
