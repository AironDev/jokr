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

Route::get('/', function () {
    return view('index');
})->name('index');;

Route::get('/friends', function () {
    return view('friends');
})->name('friends');


Route::get('/about', function () {
    return view('about');
})->name('about');

Route::get('/photos', function () {
    return view('photos');
})->name('photos');

Route::get('/profile', function () {
    return view('profile');
})->name('profile');


Route::post('/upload', function (Request $request) {
  // $content = $request->content;
  // return response()->json(['path' => $content]);

	$imgpath = $request->file->name;
    return response()->json(['location' => $imgpath]);

})->name('upload');

Route::get('/uploaded', function (Request $request) {
	
})->name('uploaded');



Route::group(['prefix' => 'laravel-filemanager', 'middleware' => ['web', 'auth']], function () {
     \UniSharp\LaravelFilemanager\Lfm::routes();
 });




Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
