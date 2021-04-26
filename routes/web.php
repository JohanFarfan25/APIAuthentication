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
//Autorutas de los foormularios AUTH
Auth::routes();

//Ruta para listar reistros
Route::get('/home', 'HomeController@index')->name('home');
///Ruta para agregar regstros
Route::post('/home', 'HomeController@store')->name('home');
//Ruta para eliminar registros
Route::delete('/home/{id}', 'HomeController@destroy')->name('home.destroy');
//Ruta para editar registros
Route::patch('/home/{id}', 'HomeController@update')->name('home.update');
//Ruta para verificar el token
Route::name('MessageVerify')->get('users/verify/{token}', 'HomeController@verify');

//Ruta de redireccionamiento al login
Route::get('/', function () {
    return view('auth.login');
})->middleware('guest');
