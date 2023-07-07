<?php

use Illuminate\Support\Facades\Route;

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
    return view('welcome');
});

Route::group(['middleware' => 'auth'], function () {
    Route::get('/create', 'App\Http\Controllers\MovieHistoryController@create')->name('historyCreate');
    Route::post('/save', 'App\Http\Controllers\MovieHistoryController@save');
    Route::get('/user/{id}', 'App\Http\Controllers\UserController@detail')->name('profile');
    Route::post('/user/{id}/update', 'App\Http\Controllers\UserController@update')->name('profileUpdate');
    Route::get('/movieHistory/{id}', 'App\Http\Controllers\MovieHistoryController@detail')->name('historyDetail');
    Route::post('/movieHistory/{id}/update', 'App\Http\Controllers\MovieHistoryController@update')->name('historyUpdate');
    Route::get('/movieHistory/{id}/delete', 'App\Http\Controllers\MovieHistoryController@delete')->name('historyDelete');
    Route::get('/movie', 'App\Http\Controllers\MovieController@index')->name('movieIndex');
    Route::get('/movie/search', 'App\Http\Controllers\MovieController@search')->name('movieSearch');
    Route::get('/movie/{id}', 'App\Http\Controllers\MovieController@detail')->name('movieDetail');
    Route::get('/movie/{id}/interest', 'App\Http\Controllers\MovieController@interest')->name('storeInterest');
    Route::get('/interest/{id}/remove', 'App\Http\Controllers\InterestController@remove')->name('removeInterest');
    Route::post('/comment/save', 'App\Http\Controllers\CommentController@save')->name('commentStore');
    Route::get('/comment/{id}/delete', 'App\Http\Controllers\CommentController@delete')->name('commentDelete');
  });

require __DIR__.'/auth.php';
