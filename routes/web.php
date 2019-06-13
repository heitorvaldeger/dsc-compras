<?php

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


Route::post('/autenticar', 'AutenticarController@AutenticarAction');

Route::group(['middleware' => ['tokenvalidate']], function(){
    Route::view('/', 'login.login')->name('login');
});
Route::get('/index', function(){
    return view('componentes.index');
})->middleware('hastoken')->name('index');

Route::get('/logout', 'AutenticarController@LogoutAction')->name('logout');
