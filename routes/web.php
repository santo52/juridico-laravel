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

Route::middleware(['auth', 'route'])->group(function () {

    Route::get('/', 'HomeController@index');
    Route::get('/logout', 'AuthController@logout');

    Route::post('/actuacion/listar', 'ActuacionController@index');
    Route::post('/actuacion/crear', 'ActuacionController@create');
    Route::post('/actuacion/insert', 'ActuacionController@insert');
    Route::post('/actuacion/{id}', 'ActuacionController@edit');
    Route::post('/actuacion/update/{id}', 'ActuacionController@update');
    Route::post('/actuacion/delete/{id}', 'ActuacionController@delete');
    Route::post('/actuacion/restore/{id}', 'ActuacionController@restore');
    Route::get('/actuacion/pdf', 'ActuacionController@createPDF');
    Route::get('/actuacion/excel', 'ActuacionController@createExcel');

    Route::post('/opciones/listar', 'MenuController@index');
    Route::post('/opciones/menu/upsert', 'MenuController@upsert');
    Route::post('/opciones/menu/{id}', 'MenuController@get');
    Route::post('/opciones/menu/delete/{id}', 'MenuController@delete');
    Route::post('/opciones/accion/delete/{id}', 'AccionController@delete');
    Route::post('/opciones/accion/upsert', 'AccionController@upsert');
    Route::post('/opciones/accion/{id}', 'AccionController@get');


    Route::post('/perfil/listar', 'PerfilController@index');
    Route::post('/perfil/get/{id}', 'PerfilController@get');
    Route::post('/perfil/create', 'PerfilController@create');
    Route::post('/perfil/menu/insert', 'PerfilController@insertMenu');
    Route::post('/perfil/menu/delete/{id}', 'PerfilController@deleteMenu');
    Route::post('/perfil/menu/accion/addremove', 'PerfilController@addOrRemovePermission');
    Route::post('/perfil/delete/{id}', 'PerfilController@delete');

    Route::post('/etapa-proceso/listar', 'EtapaProcesoController@index');
    Route::post('/etapa-proceso/upsert', 'EtapaProcesoController@upsert');
    Route::post('/etapa-proceso/get/{id}', 'EtapaProcesoController@get');
    Route::post('/etapa-proceso/delete/{id}', 'EtapaProcesoController@delete');

    Route::post('/documento/listar', 'DocumentoController@index');
    Route::post('/documento/upsert', 'DocumentoController@upsert');
    Route::post('/documento/get/{id}', 'DocumentoController@get');
    Route::post('/documento/delete/{id}', 'DocumentoController@delete');

    Route::post('/tipo-proceso/listar', 'TipoProcesoController@index');
    Route::post('/tipo-proceso/upsert', 'TipoProcesoController@upsert');
    Route::post('/tipo-proceso/get/{id}', 'TipoProcesoController@get');
    Route::post('/tipo-proceso/delete/{id}', 'TipoProcesoController@delete');
    Route::post('/tipo-proceso/etapa/insert', 'TipoProcesoController@insertEtapa');
    Route::post('/tipo-proceso/etapa/delete', 'TipoProcesoController@deleteEtapa');
    Route::post('/tipo-proceso/etapa/update', 'TipoProcesoController@updateEtapa');





    // Route::post('/proceso/listar', 'ActuacionController@index');
    // Route::post('/tipoproceso/listar', 'ActuacionController@index');
    // Route::post('/etapaproceso/listar', 'ActuacionController@index');
    // Route::post('/documento/listar', 'ActuacionController@index');
    // Route::post('/plantilladocumento/listar', 'ActuacionController@index');
    // Route::post('/entidadpension/listar', 'ActuacionController@index');
    // Route::post('/entidadjusticia/listar', 'ActuacionController@index');
    // Route::post('/entermediario/listar', 'ActuacionController@index');
    // Route::post('/actuacionetapaproceso/listar', 'ActuacionController@index');
    // Route::post('/cliente/listar', 'ActuacionController@index');
    // Route::post('/usuario/listar', 'ActuacionController@index');

});

Route::middleware('no-auth')->group(function () {
    Route::get('/login', 'AuthController@index')->name('login');
    Route::post('/login', 'AuthController@login');
});

Route::post('/error/submit', 'ErrorLogController@submit');
