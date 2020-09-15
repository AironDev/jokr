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

Route::get('/signup', 'PageController@signup')->name('signup');

// Page Controller Endpoints
Route::group(['middleware' => ['web', 'auth']], function () {
	Route::get('/', 'PageController@index')->name('index');;
	Route::get('/friends', 'PageController@friends')->name('friends');
	Route::get('/about', 'PageController@about')->name('about');
	Route::get('/photos', 'PageController@photos')->name('photos');
	Route::get('/profile/{username?}', 'PageController@profile')->name('profile');
	
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


// Filemanager Endpoints
Route::group(['prefix' => 'laravel-filemanager', 'middleware' => ['web', 'auth']], function () {
     \UniSharp\LaravelFilemanager\Lfm::routes();
 }); 

// 
Route::get('/home', 'HomeController@index')->name('home');

// Web Authentication Endpoints
Auth::routes();