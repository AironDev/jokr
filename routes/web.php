<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;

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

Route::get('/', 'PageController@index')->name('index');;

Route::get('/friends', 'PageController@friends')->name('friends');

Route::get('/about', 'PageController@about')->name('about');


Route::get('/photos', 'PageController@photos')->name('photos');

Route::get('/profile/{username?}', 'PageController@profile')->name('profile');

Route::resource('/posts', 'PostController');

Route::group(['prefix' => 'laravel-filemanager', 'middleware' => ['web', 'auth']], function () {
     \UniSharp\LaravelFilemanager\Lfm::routes();
 });

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
