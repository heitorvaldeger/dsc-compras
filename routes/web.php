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
    Route::prefix('unidades')->group(function(){
        Route::get('/', 'UnidadeController@IndexUnidades')->name('indexU');
        Route::view('cadastrar', 'componentes.unidade.cadastrar')->name('cadastrarU');
        Route::post('cadastrar', 'UnidadeController@Cadastrar')->name('cadastrarU');
        Route::post('atualizar/{id}', 'UnidadeController@Atualizar')->name('atualizarU');
        Route::get('atualizar/{id}', 'UnidadeController@RenderUpdate')->name('atualizarU');
    });

    //Rotas para FORNECEDOR
    Route::prefix('fornecedors')->group(function(){
        Route::get('/', 'FornecedorController@Index')->name('indexF');
        Route::view('cadastrar', 'componentes.fornecedor.cadastrar')->name('cadastrarF');
        Route::post('cadastrar', 'FornecedorController@Cadastrar')->name('cadastrarF');
        Route::get('atualizar/{id}', 'FornecedorController@BuscarFornecedorsID')->name('atualizarF');
        Route::post('atualizar/{id}', 'FornecedorController@Atualizar')->name('atualizarF');
    });

    //Rotas para INSUMOS
    Route::prefix('insumos')->group(function(){
        Route::get('/', 'InsumoController@Index')->name('indexI');
        Route::get('cadastrar', 'InsumoController@BuscarFornecedorsUnidades')->name('cadastrarI');
        Route::post('cadastrar', 'InsumoController@Cadastrar')->name('cadastrarI');
        Route::get('atualizar/{id}', 'InsumoController@BuscarInsumoID')->name('atualizarI');
        Route::post('atualizar/{id}', 'InsumoController@Atualizar')->name('atualizarI');
    });

    //Rotas para COMPRAS
    Route::prefix('compras')->group(function(){
        Route::get('/', 'ComprasController@Index')->name('indexC');
        Route::get('realizar/{id}', 'ComprasController@BuscarInsumo')->name('cadastrarC');
        Route::post('realizar/', 'ComprasController@RealizarCompra')->name('realizarC');
        Route::post('balanco', 'ComprasController@Balanco')->name('balancoC');
        Route::get('balanco', 'ComprasController@IndexBalanco')->name('balancoIndex');
    });
});
