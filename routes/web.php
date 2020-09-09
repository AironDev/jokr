<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use App\Notifications\PostReaction;
use App\Post;
use App\User;
use Cog\Contracts\Love\ReactionType\Models\ReactionType;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// Return curent auth user - called from vue components
Route::get('/user', function(){
	return Auth::user();
});

Route::group(['middleware' => ['web', 'auth']], function () {
	Route::get('/', 'PageController@index')->name('index');;
	Route::get('/friends', 'PageController@friends')->name('friends');
	Route::get('/about', 'PageController@about')->name('about');
	Route::get('/photos', 'PageController@photos')->name('photos');
	Route::get('/profile/{username?}', 'PageController@profile')->name('profile');
	Route::resource('/posts', 'PostController');   
 });


Route::group(['prefix' => 'laravel-filemanager', 'middleware' => ['web', 'auth']], function () {
     \UniSharp\LaravelFilemanager\Lfm::routes();
 });

Auth::routes();

Route::get('/notify', function(){
	$notify = Auth::user()->notify(new PostReaction(['post_id' => 3, 'user_id' => 1, 'type' => 'likes', 'message' => 'John Okporo likes your post']));
	return $notify;
});


Route::get('/react', function(){

	//reacter (reacterable instance)
	$user = User::find(2); 

	//reactant (reactable instance)
	$post = Post::find(1); 

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
	$funnyReactionCounters = $postReactionInterface->getReactionCounterOfType('funny'); 
	$madohReactionCounter = $postReactionInterface->getReactionCounterOfType('madoh');
	$funnyReactionCount = $postReactionInterface->getReactionCounterOfType('funny')->getCount(); // get integer count


	$isReactedBy = $postReactionInterface->isReactedBy($user);

	return response()->json(['userReactions' => $allReactionCounters[0]->getReactionType()]);
});

Route::get('/user_reaction', function(Request $request){
	$post = Post::where('id', $request->post_id)->first();
	$user = User::where('id', $request->user_id )->first();
	$userReactionInterface = $user->viaLoveReacter();
	$userLike = $userReactionInterface->hasReactedTo($post);


	return $userLike;
});


Route::group(['prefix' => 'api', 'namespace' => 'Api', 'middleware' => ['auth']], function(){
    
    Route::get('/posts', 'PostController@index');

    Route::get('/post/react', function(Request $request){
		$user = User::find($request->auth_user_id); 
		$post = Post::find($request->post_id);
		$type = $request->type;
		$rate = (int)$request->rate;

		if($user->id != Auth::user()->id){
			return "are you a marlian ?";
		}

		// user model instance of the Reacterable interface
		$userReactionInterface = $user->viaLoveReacter(); 
		// post model instance of the Reactable interface
		$postReactionInterface = $post->viaLoveReactant();
		$userNotReacted = $userReactionInterface->hasNotReactedTo($post, $type); 

		if($userNotReacted){
			$userReactionInterface->reactTo($post, $type, $rate);
			return 'reacted';
		}else{
			$userReactionInterface->unreactTo($post, $type, $rate);
			return 'unreacted';
		}
    	//return $request->post_id;
    });
    
});

Route::get('/home', 'HomeController@index')->name('home');
