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
})->name('welcome');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
Route::get('/root', 'GameController@random');
/*
Route::get('/root', function () {
    return view('root');
});
*/
Route::get('/game/{serachgamename}', 'GameController@index');
Route::get('/game/{serachgamename}/{videoid}', 'GameController@show');
Route::get('/admin', function () {
    return view('admin.admin');
});
Route::get('/admin/download', 'AdminController@download');
Route::get('/admin/platform', 'AdminController@platform');
Route::get('/admin/platform/{id}', 'AdminController@show_platform');
Route::post('/admin/platform', 'AdminController@update_platform');
Route::get('/admin/create', 'AdminController@create');
Route::get('/admin/game/{id}', 'AdminController@show_game');
Route::post('/admin/game', 'AdminController@update_game');
Route::get('/admin/edit', 'AdminController@edit');
Route::get('/admin/gamealias/{id}', 'AdminController@show_gamealias');
Route::post('/admin/gamealias', 'AdminController@update_gamealias');

Route::get('/admin/request','ApiController@index_request');
Route::get('/admin/request/create', function () {
    return view('admin.api_create');
});
Route::post('/admin/request/store','ApiController@store_request');
