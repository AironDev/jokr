<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Post;
use App\User;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

// Route::group(['namespace' => 'Api', 'middleware' => ['api']], function(){
    
//     Route::get('/posts', 'PostController@index');

//     Route::get('/post/react', function(Request $request){
// 		$user = User::find($request->auth_user_id); 
// 		$post = Post::find($request->post_id);
// 		$type = $request->type;

// 		if($user->id != Auth::user()->id){
// 			return "please login";
// 		}

// 		// user model instance of the Reacterable interface
// 		$userReactionInterface = $user->viaLoveReacter(); 
// 		// post model instance of the Reactable interface
// 		$postReactionInterface = $post->viaLoveReactant();
// 		$userNotReacted = $userReactionInterface->hasNotReactedTo($post, $type); 

// 		if($userNotReacted){
// 			$userReactionInterface->reactTo($post, $type);
// 			return 'reacted';
// 		}else{
// 			$userReactionInterface->unreactTo($post, $type);
// 			return 'unreacted';
// 		}
//     	//return $request->post_id;
//     });
    
// });
