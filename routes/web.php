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

Route::get('/', 'GameController@welcome');

/*
Route::get('/', function () {
    return view('welcome');
})->name('welcome');
*/

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
Route::get('/root/{typeid}', 'GameController@root');
Route::get('/root/{typeid}/{sortid}', 'GameController@root_sort');
Route::post('/root/{typeid}/filter', 'GameController@root_filter');
/*
Route::get('/root', function () {
    return view('root');
});
*/
Route::get('/game/{typeid}/{serachgamename}', 'GameController@index');
//Route::get('/game_mobile/{serachgamename}', 'GameController@index_mobile');
Route::get('/game/{typeid}/{serachgamename}/{videoid}', 'GameController@show');
Route::get('/admin', function () {
    return view('admin.admin');
});
Route::get('/admin/download', 'AdminController@download');
Route::get('/admin/download_android', 'AdminController@download_android');
Route::get('/admin/platform', 'AdminController@platform');
Route::get('/admin/platform/{id}', 'AdminController@show_platform');
Route::post('/admin/platform', 'AdminController@update_platform');
Route::get('/admin/create', 'AdminController@create');
Route::get('/admin/create_android', 'AdminController@create_android');
Route::get('/admin/game/{id}', 'AdminController@show_game');
Route::get('/admin/game_android/{id}', 'AdminController@show_game_android');
Route::post('/admin/game', 'AdminController@update_game');
Route::post('/admin/game_android', 'AdminController@update_game_android');
Route::get('/admin/edit', 'AdminController@edit');
Route::get('/admin/edit_android', 'AdminController@edit_android');
Route::get('/admin/gamealias/{id}', 'AdminController@show_gamealias');
Route::get('/admin/gamealias_android/{id}', 'AdminController@show_gamealias_android');
Route::post('/admin/gamealias', 'AdminController@update_gamealias');
Route::post('/admin/gamealias_android', 'AdminController@update_gamealias_android');

Route::get('/admin/request','ApiController@index_request');
Route::get('/admin/request/create', function () {
    return view('admin.api_create');
});
Route::post('/admin/request/store','ApiController@store_request');
