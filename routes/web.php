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

Route::group(['middleware' => ['hastoken']], function(){
    Route::get('/index', function(){
        return view('componentes.index');
    })->name('index'); 
    Route::get('/logout', 'AutenticarController@LogoutAction')->name('logout');
    Route::get('/profile/{id}', 'UserController@ViewProfileAction')->name('profile');

    Route::get('/unidades', 'UnidadeController@IndexUnidades')->name('indexU');
    Route::post('/unidades/salvar', 'UnidadeController@CadastrarUnidade')
        ->name('salvarU')
        ->middleware('unidadecoru');

    Route::get('/fornecedors', 'FornecedorController@Index')->name('indexF');
    Route::post('/fornecedors/salvar', 'FornecedorController@Cadastrar')
        ->name('salvarF')
        ->middleware('fornecedorcoru');
    
    Route::get('/insumos', 'InsumoController@Index')->name('indexI');
    Route::post('/insumos/salvar', 'InsumoController@Cadastrar')
        ->name('salvarI')
        ->middleware('insumocoru');
});
