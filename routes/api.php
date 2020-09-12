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

// ROUTES to test laravel love methods
Route::get('/react', function(){

	//reacter (reacterable instance)
	$user = User::find(2); 

	//reactant (reactable instance)
	$post = Post::find(25); 

	// user model instance of the Reacterable interface
	$userReactionInterface = $user->viaLoveReacter(); 
	// post model instance of the Reactable interface
	$postReactionInterface = $post->viaLoveReactant(); 
	
	//$userReactionInterface->reactTo($post, 'funny'); // reacts to a post
	// $userReactionInterface->unreactTo($post, 'funny'); // unreact to a post


	// Determine if Reacter reacted to Reactant with any type of reaction.
	//bool to specify if a user instance has reacted to the post
	$userReacted = $userReactionInterface->hasReactedTo($post);
	$userNotReacted = $userReactionInterface->hasNotReactedTo($post);
	// $userReacted = $reacter->hasReactedTo($reactant, 'madoh' ); //determine if user has reacted with a type
	// $userNotReacted = $reacter->hasNotReactedTo($reactant, 'funny');

	//Get Reactions Which Reacter Has Made
	$userReactions = $userReactionInterface->getReactions(); 

	//Get all post reactions and counters (array)
	$allReactionCounters = $postReactionInterface->getReactionCounters();
	// Total is sum of counters of all reaction types.
	$reactionTotal = $postReactionInterface->getReactionTotal(); 

	//get counter for specified reaction type for a given post (reactable item)
	$funnyReactionCounters = $postReactionInterface->getReactionCounterOfType('lol'); 
	$madohReactionCounter = $postReactionInterface->getReactionCounterOfType('smh');
	$funnyReactionCount = $postReactionInterface->getReactionCounterOfType('lol')->getCount(); // get integer count


	$isReactedBy = $postReactionInterface->isReactedBy($user);

	$reacters = $postReactionInterface->getReactions()->unique(function($item){
		return $item['reacter_id'];
	})->values()->all();

	$reactions = [
                'total' => $postReactionInterface->getReactionTotal()->getCount(),
                'points' => $postReactionInterface->getReactionTotal()->getWeight(),
                'reacters' => count($reacters),
                'status' => 'reacted',
            ];

	return response()->json(['userReactions' => $reactions['reacters']]);
});
