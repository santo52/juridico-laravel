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

    Route::post('/etapas-de-proceso/listar', 'EtapaProcesoController@index');
    Route::post('/etapas-de-proceso/upsert', 'EtapaProcesoController@upsert');
    Route::post('/etapas-de-proceso/get/{id}', 'EtapaProcesoController@get');
    Route::post('/etapas-de-proceso/delete/{id}', 'EtapaProcesoController@delete');
    Route::post('/etapas-de-proceso/actuacion/insert', 'EtapaProcesoController@insertActuacion');
    Route::post('/etapas-de-proceso/actuacion/delete/{id}', 'EtapaProcesoController@deleteActuacion');
    Route::post('/etapas-de-proceso/actuacion/get/{id}', 'EtapaProcesoController@getActuacion');
    Route::post('/etapas-de-proceso/actuacion/order/update', 'EtapaProcesoController@updateOrderActuacion');

    Route::post('/documento/listar', 'DocumentoController@index');
    Route::post('/documento/upsert', 'DocumentoController@upsert');
    Route::post('/documento/get/{id}', 'DocumentoController@get');
    Route::post('/documento/delete/{id}', 'DocumentoController@delete');

    Route::post('/tipos-de-proceso/listar', 'TipoProcesoController@index');
    Route::post('/tipos-de-proceso/upsert', 'TipoProcesoController@upsert');
    Route::post('/tipos-de-proceso/get/{id}', 'TipoProcesoController@get');
    Route::post('/tipos-de-proceso/delete/{id}', 'TipoProcesoController@delete');
    Route::post('/tipos-de-proceso/etapa/insert', 'TipoProcesoController@insertEtapa');
    Route::post('/tipos-de-proceso/etapa/delete', 'TipoProcesoController@deleteEtapa');
    Route::post('/tipos-de-proceso/etapa/update', 'TipoProcesoController@updateEtapa');

    Route::post('/entidades-demandadas/listar', 'EntidadDemandadaController@index');
    Route::post('/entidades-demandadas/upsert', 'EntidadDemandadaController@upsert');
    Route::post('/entidades-demandadas/get/{id}', 'EntidadDemandadaController@get');
    Route::post('/entidades-demandadas/delete/{id}', 'EntidadDemandadaController@delete');

    Route::post('/entidades-de-justicia/listar', 'EntidadJusticiaController@index');
    Route::post('/entidades-de-justicia/upsert', 'EntidadJusticiaController@upsert');
    Route::post('/entidades-de-justicia/get/{id}', 'EntidadJusticiaController@get');
    Route::post('/entidades-de-justicia/delete/{id}', 'EntidadJusticiaController@delete');

    Route::post('/intermediario/listar', 'IntermediarioController@index');
    Route::post('/intermediario/upsert', 'IntermediarioController@upsert');
    Route::post('/intermediario/get/{id}', 'IntermediarioController@get');
    Route::post('/intermediario/delete/{id}', 'IntermediarioController@delete');
    Route::post('/intermediario/municipio/{id}', 'IntermediarioController@getMunicipio');

    Route::post('/usuario/listar', 'UsuarioController@index');
    Route::post('/usuario/upsert', 'UsuarioController@upsert');
    Route::post('/usuario/get/{id}', 'UsuarioController@get');
    Route::post('/usuario/delete/{id}', 'UsuarioController@delete');
    Route::post('/usuario/municipio/{id}', 'UsuarioController@getMunicipio');

    Route::post('/cliente/listar', 'ClienteController@index');
    Route::post('/cliente/upsert', 'ClienteController@upsert');
    Route::post('/cliente/{id}', 'ClienteController@get');
    Route::post('/cliente/basic/{id}', 'ClienteController@getBasic');
    Route::post('/cliente/delete/{id}', 'ClienteController@delete');

    Route::post('/proceso/listar', 'ProcesoController@index');
    Route::post('/proceso/upsert', 'ProcesoController@upsert');
    Route::post('/proceso/upload', 'ProcesoController@uploadFile');
    Route::post('/proceso/upload/delete', 'ProcesoController@deleteFile');
    Route::post('/proceso/delete/{id}', 'ProcesoController@delete');
    Route::post('/proceso/{id}', 'ProcesoController@get');


    Route::post('/departamento/municipios/{id}', 'DepartamentoController@getMunicipios');



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
