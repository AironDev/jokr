<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\User;
use Illuminate\Support\Facades\Auth;

class NotificationController extends Controller
{   //all calls to this controller must carry an auth_user_id
    private $user; 

    public function __construct(Request $request){
        $this->middleware('auth');
    }

    public function authUser(){
        return $this->auth_user;

    }

    public function checkAuth(Request $request){
        if(Auth::user()->id != $request->user_id){
            die;
        }
        $this->user = Auth::user();
    }

    public function userNotifications(Request $request){
        $this->checkAuth($request);
        $notifications = $this->user->notifications;
        //$unreadNotifications = $user->unreadNotifications
        $notification = [];
        $data = [];
        foreach ($notifications as $key => $value) {
            array_push($notification, $value->data);
        }
        foreach ($notification as $value) {
           array_push($data, $value[0]);
        }
        return response()->json( $data);
    }
}
