<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use App\User;
use Illuminate\Support\Carbon;


class NotificationResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        $user = User::where('id', $this->data['user_id'])->with('profile:user_id,photo')->first();
        $date = Carbon::create($this['date']);

        return [
            'id' => $this->id,
            'username' => $user->name,
            'photo' => $user->profile->photo,
            'post_id' => $this->data['post_id'],
            'date' => $this->created_at->diffForHumans(),
            'reaction_count' => $this->data['reaction_count'],
        ];
    }
}
