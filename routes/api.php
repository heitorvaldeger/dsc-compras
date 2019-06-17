<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('unidades/salvar/{id?}', function(Request $request){
   
});

Route::get('unidades/listar', function(Request $request){

    $array = [
        "id" => 1,
        "descricao" => "Quilograma",
        "grama" => 1000
    ];
    $array2 = [
        "id" => 2,
        "descricao" => "Quilograma",
        "grama" => 1000
    ];
    $array3 = [
        "id" => 3,
        "descricao" => "Quilograma",
        "grama" => 1000
    ];
    return response()->json([
        $array,
        $array2,
        $array3
    ]);
});