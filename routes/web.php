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

Route::middleware('auth')->group(function () {
    Route::get('/', 'HomeController@index');
    Route::post('/actuacion/crear', 'ActuacionController@create');
    Route::post('/actuacion/insert', 'ActuacionController@insert');
    Route::post('/actuacion/{id}', 'ActuacionController@edit');
    Route::post('/actuacion/update/{id}', 'ActuacionController@update');
    Route::post('/actuacion/delete/{id}', 'ActuacionController@delete');
    Route::post('/actuacion/restore/{id}', 'ActuacionController@restore');
    Route::post('/actuacion', 'ActuacionController@index');


});

Route::middleware('no-auth')->group(function () {
    Route::get('/login', 'AuthController@index')->name('login');
    Route::post('/login', 'AuthController@login');
});

Route::post('/error/submit', 'ErrorLogController@submit');
