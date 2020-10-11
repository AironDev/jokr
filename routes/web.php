<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use App\Notifications\PostReaction;
use App\Post;
use App\User;
use Cog\Contracts\Love\ReactionType\Models\ReactionType;
// use Illuminate\Support\Str;

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
Route::get('/csrf', function(){
	return csrf_token();
});

// Return curent auth user crsf token- called from vue components
Route::get('/user/{id}', function($id){
	$user = User::where('id', $id)->with('profile')->first();
	return response()->json($user);
});

Route::get('/slug/{id}', function($id){
	$user = User::find($id);
	$user->username = Str::slug($user->name, '-');
	$user->save();
	return $user;
});

// Profile Controller Endpoints
Route::group(['middleware'=>['web', 'auth']], function(){
	Route::get('/profile/{username?}', 'ProfileController@index')->name('profile');
	Route::get('/profile/settings', 'ProfileController@edit')->name('profile.edit');
	Route::patch('/profile/settings', 'ProfileController@update')->name('profile.update');
	Route::put('profile/password', ['as' => 'profile.password', 'uses' => 'ProfileController@password']);
});


// Auth/Guest Routes
Route::group(['middleware'=>['web', 'guest']], function(){
	Route::get('/signup', 'UserController@signup')->name('signup');
	Route::get('/signin', 'UserController@signin')->name('signin');
	Route::post('/signin', 'Auth\AuthController@signIn')->name('signin.store');
	Route::post('/signup', 'Auth\AuthController@signup')->name('signup.store');
});


// User Pages Controller Endpoints
Route::group(['middleware' => ['web', 'auth']], function () {
	Route::get('/', 'UserController@index')->name('user.index');;
	Route::get('/friends', 'UserController@friends')->name('friends');
	Route::get('/about', 'UserController@about')->name('about');
	Route::get('/photos', 'UserController@photos')->name('photos');	
 });


// Notifications Endpoints
Route::group(['middleware' => [ 'web']], function(){
	 Route::get('/notifications', 'NotificationController@userNotifications');
	 Route::get('/read', 'NotificationController@markAsRead');
});



// Post Endpoints
Route::group(['middleware' => ['auth', 'web']], function(){
    Route::get('/posts', 'PostController@index');
    Route::get('/post/react', 'PostController@react');
    Route::post('/posts', 'PostController@store')->name('posts.store');  
   
});


// Comments Endpoints
Route::group(['middleware' => [ 'web']], function(){
    Route::post('/posts/{id}/comment', 'CommentController@storeComment')->name('post.comment.store');
    Route::get('/posts/{id}/comments', 'CommentController@getComments')->name('post.comments.get');
    // Route::get('/post/react', 'PostController@react');
    // Route::post('/posts', 'PostController@store')->name('posts.store');  
   
});


// Filemanager Endpoints
Route::group(['prefix' => 'laravel-filemanager', 'middleware' => ['web', 'auth']], function () {
     \UniSharp\LaravelFilemanager\Lfm::routes();
 }); 

// 
Route::get('/home', 'HomeController@index')->name('home');

Route::get('/test', function(){
	return response()->json('hellp', 200);
});



// ADMIN
Route::group(['prefix' => 'admin', 'namespace' => 'Admin', 'middleware' => ['auth'] ], function () {
     Route::get('/', 'DashboardController@index')->name('admin.index');
});

// Web Authentication Endpoints
Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');



