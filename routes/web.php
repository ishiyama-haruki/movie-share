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
Route::get('/create', 'App\Http\Controllers\MovieHistoryController@create');
Route::post('/save', 'App\Http\Controllers\MovieHistoryController@save');
Route::get('/user/{id}', 'App\Http\Controllers\UserController@detail')->name('profile');

