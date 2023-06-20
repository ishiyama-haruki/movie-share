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

Route::get('/create', 'App\Http\Controllers\MovieHistoryController@create')->name('historyCreate');
Route::post('/save', 'App\Http\Controllers\MovieHistoryController@save');
Route::get('/user/{id}', 'App\Http\Controllers\UserController@detail')->name('profile');
Route::get('/movieHistory/{id}', 'App\Http\Controllers\MovieHistoryController@detail')->name('historyDetail');
Route::post('/movieHistory/{id}/update', 'App\Http\Controllers\MovieHistoryController@update')->name('historyUpdate');
Route::get('/movieHistory/{id}/delete', 'App\Http\Controllers\MovieHistoryController@delete')->name('historyDelete');
Route::get('/movie', 'App\Http\Controllers\MovieController@index')->name('movieIndex');
Route::get('/movie/{id}', 'App\Http\Controllers\MovieController@detail')->name('movieDetail');


Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

require __DIR__.'/auth.php';
