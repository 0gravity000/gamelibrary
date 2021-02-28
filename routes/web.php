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

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
Route::get('/root', function () {
    return view('root');
});
Route::post('/game', 'GameController@index');
Route::get('/game/{serachgamename}/{videoid}', 'GameController@show');
Route::get('/admin', function () {
    return view('admin');
});
Route::get('/admin/download', 'AdminController@download');
