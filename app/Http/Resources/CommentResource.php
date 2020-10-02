<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use App\User;
use Illuminate\Support\Carbon;

class CommentResource extends JsonResource
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
            'username' => $user->name,
            'display_name' => $user->display_name,
            'photo' => $user->profile->photo,
        ]);
        return [
            'id' => $this->id,
            'post_id ' => $this->post_id,
            'date' => $this->created_at->diffForHumans(),
            'content' => $this->content,
            'user' => $user,
        ];
    }
}
