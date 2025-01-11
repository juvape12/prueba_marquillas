<?php

header('Content-type: application/json; charset=UTF-8');
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: X-API-KEY, Origin, X-Requested-With, Content-Type, Accept, Authorization, username, password, Access-Control-Allow-Origin");
header("Access-Control-Allow-Methods: GET, POST, OPTIONS, PUT, DELETE");
header("Allow: GET, POST, OPTIONS, PUT, DELETE");

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('app/categoria_store', 'CategoriaController@store');
Route::post('app/producto_store', 'ProductoController@store');
Route::put('app/producto_update', 'ProductoController@update');
Route::get('app/producto_consultar', 'ProductoController@index');
Route::get('app/producto_consultar_id', 'ProductoController@show');
Route::delete('app/producto_delete', 'ProductoController@delete');
