<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

Route::post('usuarios', 'UsuarioController@store');
Route::post('veiculos', 'VeiculoController@store');
Route::post('clientes', 'ClienteController@store');

Route::put('usuarios/{id}', 'UsuarioController@update');
Route::put('veiculos/{id}', 'VeiculoController@update');
Route::put('clientes/{id}', 'ClienteController@update');

Route::get('usuarios/{id}', 'UsuarioController@show');
Route::get('veiculos/{id}', 'VeiculoController@show');
Route::get('clientes/{id}', 'ClienteController@show');

Route::get('usuarios', 'UsuarioController@show');
Route::get('veiculos', 'VeiculoController@show');
Route::get('clientes', 'ClienteController@show');

Route::delete('usuarios', 'UsuarioController@destroy');
Route::delete('veiculos', 'VeiculoController@destroy');
Route::delete('clientes', 'ClienteController@destroy');

Route::post('aluguel_carros', 'AluguelCarroController@createRentCar');
Route::put('aluguel_carros', 'AluguelCarroController@returnCar');
