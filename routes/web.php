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

// create slug for username
Route::get('/slug/{id}', function($id){
	$user = User::find($id);
	$user->username = Str::slug($user->name, '-');
	$user->save();
	return $user;
});

// Profile Controller Endpoints
Route::group(['middleware'=>['web', 'auth']], function(){
	Route::get('/profile/settings', 'ProfileController@edit')->name('profile.edit');
	Route::get('/profile/{username?}', 'ProfileController@index')->name('profile');
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


// Auth User Notifications Endpoints
Route::group(['middleware' => [ 'web', 'auth']], function(){
	Route::get('/user/notifications', 'NotificationController@userNotifications');
	Route::get('/user/notifications/{id}/read', 'NotificationController@markAsRead');
	Route::patch('/user/notifications/{id}/read', 'NotificationController@markAsRead');
});



// Post Endpoints
Route::group(['middleware' => ['auth', 'web']], function(){
    Route::get('/posts', 'PostController@index');
    Route::post('/post/react', 'PostController@react');
    Route::post('/posts', 'PostController@store')->name('posts.store');  
   
});


// Comments Endpoints
Route::group(['middleware' => [ 'web', 'auth']], function(){
    Route::post('/posts/{id}/comment', 'CommentController@storeComment')->name('post.comment.store');
    Route::get('/posts/{id}/comments', 'CommentController@getComments')->name('post.comments.get');
    // Route::get('/post/react', 'PostController@react');
    // Route::post('/posts', 'PostController@store')->name('posts.store');  
   
});


// Filemanager Endpoints
Route::group(['prefix' => 'laravel-filemanager', 'middleware' => ['web', 'auth']], function () {
     \UniSharp\LaravelFilemanager\Lfm::routes();
 }); 


// ADMIN ENDPOINTS GROUP
Route::group(['prefix' => 'admin', 'namespace' => 'Admin', 'middleware' => ['web'] ], function () {
	// Dashboard
     Route::get('/', 'DashboardController@index')->name('admin.index');

     // User and Profile Management
     Route::get('/users', 'UserController@index')->name('admin.users.index'); // admin/users
     Route::post('/users/create/', 'UserController@create')->name('admin.users.create'); 
     Route::get('/users/edit/{userId}', 'UserController@edit')->name('admin.users.edit'); //admin/edit/airon
     Route::patch('/users/update/{userId}', 'UserController@update')->name('admin.users.update');
     Route::put('/users/change_password/{userId}', 'UserController@changePassword')->name('admin.users.password');
     Route::delete('/users/delete/{userId}', 'UserController@destroy')->name('admin.users.delete');


     /*RBAC
		// RBAC Endpoints
     */
     Route::get('/rbac', 'RbacController@rbac')->name('rbac'); // Single page to create new Role and Ability
     Route::get('/rbac/roles', 'RbacController@getRoles')->name('rbac.roles');
     Route::get('/rbac/roles/{name?}', 'RbacController@getSingleRole')->name('rbac.role');
     Route::get('/rbac/abilities', 'RbacController@getAbilities')->name('rbac.abilities');
     
     // Attach Ability to Role
     Route::get('/rbac/attach', 'RbacController@attachAbilityToRole')->name('rbac.attach');
     Route::post('/rbac/attach', 'RbacController@attachAbilityToRole')->name('rbac.attach.ability');

     // Assign role to a user
     Route::post('/rbac/assign/{user_id}', 'RbacController@assignUserRole')->name('rbac.assign.role');
     // Get user role
     Route::get('/rbac/user/roles/{user_id?}', 'RbacController@getUserRoles')->name('rbac.user.roles');
     // Get user abilities
     Route::get('/rbac/user/abilities/{user_id?}', 'RbacController@getUserAbilities')->name('rbac.user.abilities');
     // Retract role from user
     Route::post('/rbac/retract/{user_id}', 'RbacController@retractUserRole')->name('rbac.retract.role');


     // Store the newly created role and abiltit
     Route::post('/rbac/create/role', 'RbacController@storeRole')->name('rbac.store.role');
     Route::post('/rbac/create/ability', 'RbacController@storeAbility')->name('rbac.store.ability');
});







/*
	MISC ROUTES
*/

Route::get('/home', 'HomeController@index')->name('home');

 // Return curent auth user crsf token- called from vue components
Route::get('/user/{id}', function($id){
	$user = User::where('id', $id)->with('profile')->first();
	return response()->json($user);
});

// Return curent auth user - called from vue components
Route::get('/csrf', function(){
	return csrf_token();
});

// Test anything here
Route::get('/test', function(){
	$post = Post::find(25);
	return response()->json($post->owner());
});

Route::get('/models', "Admin\RbacController@getModels");
// Web Authentication Endpoints
Auth::routes();


