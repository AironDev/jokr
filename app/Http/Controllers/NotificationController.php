<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\User;
use Illuminate\Support\Facades\Auth;
use App\Http\Resources\NotificationResource;
use Illuminate\Support\Facades\DB;

class NotificationController extends Controller
{   //all calls to this controller must carry an auth_user_id
    private $user; 

    public function __construct(Request $request){
        $this->middleware('auth');
    }

    public function checkAuth(Request $request){
        if(Auth::user()->id != $request->user_id){
            die;
        }
        $this->user = Auth::user();
    }

    public function userNotifications(Request $request){
        $this->checkAuth($request);
        //$user = User::find(1);
        $user = $this->user;
        $userNotifications = $user->unreadNotifications;

        $notifications = collect($userNotifications)->unique(function($item){
            return $item->data['post_id'];
        })->values()->all();
        
        //return ($notifications);
        return NotificationResource::collection($notifications);
    }

// Mark all notifications on a post as read
    public function markAsRead(Request $request){
        $this->checkAuth($request);
        $post_id = $request->post_id;
        $unreadNotifications = $this->user->unreadNotifications;

        //$noty = DB::table('notifications')->where('data->post_id', 25);
        foreach ($unreadNotifications as $notifications) {
           $notifications->where('data->post_id', $post_id)->get()->markAsRead();
        }

    }
}
