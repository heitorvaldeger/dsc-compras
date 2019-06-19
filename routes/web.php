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

    //Rotas para UNIDADE
    Route::get('/unidades', 'UnidadeController@IndexUnidades')->name('indexU');
    Route::view('/unidades/cadastrar', 'componentes.unidade.cadastrar')->name('cadastrarU');
    Route::post('/unidades/cadastrar', 'UnidadeController@Cadastrar')->name('cadastrarU');
    Route::post('/unidades/atualizar/{id}', 'UnidadeController@Atualizar')->name('atualizarU');
    Route::get('/unidades/atualizar/{id}', 'UnidadeController@RenderUpdate')->name('atualizarU');

    //Rotas para FORNECEDOR
    Route::get('/fornecedors', 'FornecedorController@Index')->name('indexF');
    Route::view('/fornecedors/cadastrar', 'componentes.fornecedor.cadastrar')->name('cadastrarF');
    Route::post('/fornecedors/cadastrar', 'FornecedorController@Cadastrar')->name('cadastrarF');
    Route::get('/fornecedors/atualizar/{id}', 'FornecedorController@BuscarFornecedorsID')->name('atualizarF');
    Route::post('/fornecedors/atualizar/{id}', 'FornecedorController@Atualizar')->name('atualizarF');

    //Rotas para INSUMOS
    Route::get('/insumos', 'InsumoController@Index')->name('indexI');
    Route::get('/insumos/cadastrar', 'InsumoController@BuscarFornecedorsUnidades')->name('cadastrarI');
    Route::post('/insumos/cadastrar', 'InsumoController@Cadastrar')->name('cadastrarI');
    Route::get('/insumos/atualizar/{id}', 'InsumoController@BuscarInsumoID')->name('atualizarI');
    Route::post('/insumos/atualizar/{id}', 'InsumoController@Atualizar')->name('atualizarI');
});
