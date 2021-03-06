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
    Route::post('/cambiar-contrasena/listar', 'HomeController@changePassword');
    Route::post('/cambiar-contrasena/upsert', 'HomeController@changePasswordUpsert');

    Route::get('/actuacion/pdf', 'ActuacionController@createPDF');
    Route::get('/actuacion/excel', 'ActuacionController@createExcel');
    Route::post('/actuacion/listar', 'ActuacionController@index');
    Route::post('/actuacion/crear', 'ActuacionController@create');
    Route::post('/actuacion/insert', 'ActuacionController@insert');
    Route::post('/actuacion/{id}', 'ActuacionController@edit');
    Route::post('/actuacion/update/{id}', 'ActuacionController@update');
    Route::post('/actuacion/delete/{id}', 'ActuacionController@delete');
    Route::post('/actuacion/restore/{id}', 'ActuacionController@restore');


    Route::get('/opciones/menu/pdf', 'MenuController@createPDF');
    Route::get('/opciones/menu/excel', 'MenuController@createExcel');
    Route::post('/opciones/listar', 'MenuController@index');
    Route::post('/opciones/menu/upsert', 'MenuController@upsert');
    Route::post('/opciones/menu/{id}', 'MenuController@get');
    Route::post('/opciones/menu/delete/{id}', 'MenuController@delete');
    Route::post('/opciones/accion/delete/{id}', 'AccionController@delete');
    Route::post('/opciones/accion/upsert', 'AccionController@upsert');
    Route::post('/opciones/accion/{id}', 'AccionController@get');


    Route::get('/perfil/pdf', 'PerfilController@createPDF');
    Route::get('/perfil/excel', 'PerfilController@createExcel');
    Route::post('/perfil/listar', 'PerfilController@index');
    Route::post('/perfil/get/{id}', 'PerfilController@get');
    Route::post('/perfil/create', 'PerfilController@create');
    Route::post('/perfil/menu/insert', 'PerfilController@insertMenu');
    Route::post('/perfil/menu/delete/{id}', 'PerfilController@deleteMenu');
    Route::post('/perfil/menu/accion/addremove', 'PerfilController@addOrRemovePermission');
    Route::post('/perfil/delete/{id}', 'PerfilController@delete');

    Route::get('/etapas-de-proceso/pdf', 'EtapaProcesoController@createPDF');
    Route::get('/etapas-de-proceso/excel', 'EtapaProcesoController@createExcel');
    Route::post('/etapas-de-proceso/listar', 'EtapaProcesoController@index');
    Route::post('/etapas-de-proceso/upsert', 'EtapaProcesoController@upsert');
    Route::post('/etapas-de-proceso/get/{id}', 'EtapaProcesoController@get');
    Route::post('/etapas-de-proceso/delete/{id}', 'EtapaProcesoController@delete');
    Route::post('/etapas-de-proceso/actuacion/insert', 'EtapaProcesoController@insertActuacion');
    Route::post('/etapas-de-proceso/actuacion/delete/{id}', 'EtapaProcesoController@deleteActuacion');
    Route::post('/etapas-de-proceso/actuacion/get/{id}', 'EtapaProcesoController@getActuacion');
    Route::post('/etapas-de-proceso/actuacion/all/{id}', 'EtapaProcesoController@getActuaciones');
    Route::post('/etapas-de-proceso/actuacion/order/update', 'EtapaProcesoController@updateOrderActuacion');


    Route::get('/documento/pdf', 'DocumentoController@createPDF');
    Route::get('/documento/excel', 'DocumentoController@createExcel');
    Route::post('/documento/listar', 'DocumentoController@index');
    Route::post('/documento/upsert', 'DocumentoController@upsert');
    Route::post('/documento/get/{id}', 'DocumentoController@get');
    Route::post('/documento/delete/{id}', 'DocumentoController@delete');

    Route::get('/tipos-de-proceso/pdf', 'TipoProcesoController@createPDF');
    Route::get('/tipos-de-proceso/excel', 'TipoProcesoController@createExcel');
    Route::post('/tipos-de-proceso/listar', 'TipoProcesoController@index');
    Route::post('/tipos-de-proceso/upsert', 'TipoProcesoController@upsert');
    Route::post('/tipos-de-proceso/get/{id}', 'TipoProcesoController@get');
    Route::post('/tipos-de-proceso/delete/{id}', 'TipoProcesoController@delete');
    Route::post('/tipos-de-proceso/etapa/insert', 'TipoProcesoController@insertEtapa');
    Route::post('/tipos-de-proceso/etapa/delete', 'TipoProcesoController@deleteEtapa');
    Route::post('/tipos-de-proceso/etapa/update', 'TipoProcesoController@updateEtapa');

    Route::get('/entidades-demandadas/pdf', 'EntidadDemandadaController@createPDF');
    Route::get('/entidades-demandadas/excel', 'EntidadDemandadaController@createExcel');
    Route::post('/entidades-demandadas/listar', 'EntidadDemandadaController@index');
    Route::post('/entidades-demandadas/upsert', 'EntidadDemandadaController@upsert');
    Route::post('/entidades-demandadas/get/{id}', 'EntidadDemandadaController@get');
    Route::post('/entidades-demandadas/delete/{id}', 'EntidadDemandadaController@delete');

    Route::get('/entidades-de-justicia/pdf', 'EntidadJusticiaController@createPDF');
    Route::get('/entidades-de-justicia/excel', 'EntidadJusticiaController@createExcel');
    Route::post('/entidades-de-justicia/listar', 'EntidadJusticiaController@index');
    Route::post('/entidades-de-justicia/upsert', 'EntidadJusticiaController@upsert');
    Route::post('/entidades-de-justicia/get/{id}', 'EntidadJusticiaController@get');
    Route::post('/entidades-de-justicia/delete/{id}', 'EntidadJusticiaController@delete');
    Route::post('/entidades-de-justicia/departamentos/{id}', 'PaisController@getDepartamentos');
    Route::post('/entidades-de-justicia/municipios/{id}', 'DepartamentoController@getMunicipios');

    Route::get('/intermediario/pdf', 'IntermediarioController@createPDF');
    Route::get('/intermediario/excel', 'IntermediarioController@createExcel');
    Route::post('/intermediario/listar', 'IntermediarioController@index');
    Route::post('/intermediario/upsert', 'IntermediarioController@upsert');
    Route::post('/intermediario/get/{id}', 'IntermediarioController@get');
    Route::post('/intermediario/delete/{id}', 'IntermediarioController@delete');
    Route::post('/intermediario/municipio/{id}', 'IntermediarioController@getMunicipio');

    Route::get('/usuario/pdf', 'UsuarioController@createPDF');
    Route::get('/usuario/excel', 'UsuarioController@createExcel');
    Route::post('/usuario/listar', 'UsuarioController@index');
    Route::post('/usuario/upsert', 'UsuarioController@upsert');
    Route::post('/usuario/get/{id}', 'UsuarioController@get');
    Route::post('/usuario/delete/{id}', 'UsuarioController@delete');
    Route::post('/usuario/municipio/{id}', 'UsuarioController@getMunicipio');
    Route::post('/usuario/contratos/{id}', 'UsuarioContratoController@getAll'); //Contratos por usuario
    Route::post('/usuario/contrato/upsert', 'UsuarioContratoController@upsert');
    Route::post('/usuario/contrato/{id}', 'UsuarioContratoController@get');
    Route::post('/usuario/contrato/delete/{id}', 'UsuarioContratoController@delete');

    Route::get('/cliente/pdf', 'ClienteController@createPDF');
    Route::get('/cliente/excel', 'ClienteController@createExcel');
    Route::post('/cliente/listar', 'ClienteController@index');
    Route::post('/cliente/upsert', 'ClienteController@upsert');
    Route::post('/cliente/{id}', 'ClienteController@get');
    Route::post('/cliente/basic/{id}', 'ClienteController@getBasic');
    Route::post('/cliente/delete/{id}', 'ClienteController@delete');
    Route::post('/cliente/departamentos/{id}', 'PaisController@getDepartamentos');
    Route::post('/cliente/municipios/{id}', 'DepartamentoController@getMunicipios');
    Route::post('/cliente/municipio/{id}', 'MunicipioController@get');


    Route::get('/proceso/pdf', 'ProcesoController@createPDF');
    Route::get('/proceso/excel', 'ProcesoController@createExcel');
    Route::post('/proceso/listar', 'ProcesoController@index');
    Route::post('/proceso/upsert', 'ProcesoController@upsert');
    Route::post('/proceso/tipo-proceso/documentos', 'ProcesoController@getDocumentosTipoProceso');
    Route::post('/proceso/delete/{id}', 'ProcesoController@delete');
    Route::post('/proceso/{id}', 'ProcesoController@get');

    Route::post('/departamento/municipios/{id}', 'DepartamentoController@getMunicipios');
    Route::post('/variables/all', 'VariableController@getAll');

    Route::get('/plantillas/pdf', 'PlantillaDocumentoController@createPDF');
    Route::get('/plantillas/excel', 'PlantillaDocumentoController@createExcel');
    Route::post('/plantillas/listar', 'PlantillaDocumentoController@index');
    Route::post('/plantillas/upsert', 'PlantillaDocumentoController@upsert');
    Route::post('/plantillas/delete/{id}', 'PlantillaDocumentoController@delete');
    Route::post('/plantillas/{id}', 'PlantillaDocumentoController@get');

    Route::post('/seguimiento-procesos/resultado/upload', 'SeguimientoProcesoController@uploadFileResultado');
    Route::post('/seguimiento-procesos/resultado/upload/delete', 'SeguimientoProcesoController@deleteFileResultado');
    Route::post('/seguimiento-procesos/upload', 'SeguimientoProcesoController@uploadFile');
    Route::post('/seguimiento-procesos/upload/delete', 'SeguimientoProcesoController@deleteFile');
    Route::post('/seguimiento-procesos/etapas-de-proceso/actuacion/insert', 'EtapaProcesoController@insertActuacion');
    Route::post('/seguimiento-procesos/etapas-de-proceso/get/{id}', 'EtapaProcesoController@get');
    Route::post('/seguimiento-procesos/etapas-de-proceso/actuacion/all/{id}', 'EtapaProcesoController@getActuaciones');
    Route::post('/seguimiento-procesos/listar', 'SeguimientoProcesoController@index');
    Route::post('/seguimiento-procesos/set-etapa', 'SeguimientoProcesoController@setEtapa');
    Route::post('/seguimiento-procesos/etapas/disponibles/{id}', 'SeguimientoProcesoController@getEtapasDisponibles');
    Route::post('/seguimiento-procesos/{id}', 'SeguimientoProcesoController@detalle');
    Route::post('/seguimiento-procesos/actuacion/crear/{idProcesoEtapa}/{id}', 'SeguimientoProcesoController@crearActuacion');
    Route::post('/seguimiento-procesos/actuacion/upsert', 'SeguimientoProcesoController@actuacionUpsert');
    Route::post('/seguimiento-procesos/actuacion/{id}', 'SeguimientoProcesoController@actuacion');
    Route::post('/seguimiento-procesos/actuacion/plantilla/upsert', 'SeguimientoProcesoController@actuacionPlantillaUpsert');
    Route::post('/seguimiento-procesos/actuacion/plantilla/delete/{id}', 'SeguimientoProcesoController@actuacionPlantillaDelete');
    Route::post('/seguimiento-procesos/comentario/upsert', 'ProcesoBitacoraController@upsert');
    Route::post('/seguimiento-procesos/comentario/get/{id}', 'ProcesoBitacoraController@get');
    Route::post('/seguimiento-procesos/comentario/delete/{id}', 'ProcesoBitacoraController@delete');
    Route::post('/seguimiento-procesos/comentarios/{id}', 'ProcesoBitacoraController@getByProceso');
    Route::post('/seguimiento-procesos/etapa/actuaciones/{idEtapa}', 'SeguimientoProcesoController@getActuacionesEtapa');

    Route::post('/cobros-y-pagos/listar', 'CobroController@index');
    Route::post('/cobros-y-pagos/{id}', 'CobroController@get');
    Route::post('/cobros-y-pagos/upsert', 'CobroController@upsert');
    Route::post('/cobros-y-pagos/pago/upsert', 'CobroController@upsertPago');
    Route::post('/cobros-y-pagos/cobro/get/{id}', 'CobroController@getCobro');
    Route::post('/cobros-y-pagos/pagos/get/{id}', 'CobroController@getPagos');
    Route::post('/cobros-y-pagos/pago/get/{id}', 'CobroController@getPago');

    Route::post('/honorarios/listar', 'HonorarioController@index');
    Route::post('/honorarios/upsert', 'HonorarioController@upsert');
    Route::post('/honorarios/get/{id}', 'HonorarioController@get');
    Route::post('/honorarios/delete/{id}', 'HonorarioController@delete');
    Route::post('/honorarios/cliente/{id}', 'ClienteController@getBasic');
    Route::post('/honorarios/proceso/{id}', 'HonorarioController@getProceso');
    Route::post('/honorarios/pago/upsert', 'HonorarioController@upsertPago');
    Route::post('/honorarios/pago/get/{id}', 'HonorarioController@getPago');
    Route::post('/honorarios/pagos/get/{id}', 'HonorarioController@getPagos');
    Route::post('/honorarios/pagos/delete/{id}', 'HonorarioController@deletePago');



    Route::get('/tipos-de-resultado/pdf', 'TipoResultadoController@createPDF');
    Route::get('/tipos-de-resultado/excel', 'TipoResultadoController@createExcel');
    Route::post('/tipos-de-resultado/listar', 'TipoResultadoController@index');
    Route::post('/tipos-de-resultado/upsert', 'TipoResultadoController@upsert');
    Route::post('/tipos-de-resultado/delete/{id}', 'TipoResultadoController@delete');
    Route::post('/tipos-de-resultado/get/{id}', 'TipoResultadoController@get');


    Route::post('/gestion-procesos-activos/listar', 'GestionProcesosReportController@index');
    Route::get('/gestion-procesos-activos/pdf', 'GestionProcesosReportController@pdf');
    Route::get('/gestion-procesos-activos/html', 'GestionProcesosReportController@html');

    Route::post('/estado-de-cuenta-de-procesos/listar', 'EstadoCuentaReportController@index');
    Route::get('/estado-de-cuenta-de-procesos/pdf', 'EstadoCuentaReportController@pdf');
    Route::get('/estado-de-cuenta-de-procesos/html', 'EstadoCuentaReportController@html');

    Route::post('/honorarios-y-gastos-procesales/listar', 'HonorariosGastosReportController@index');
    Route::get('/honorarios-y-gastos-procesales/pdf', 'HonorariosGastosReportController@pdf');
    Route::get('/honorarios-y-gastos-procesales/html', 'HonorariosGastosReportController@html');

    Route::post('/gestion-organizacional/listar', 'GestionOrganizacionalReportController@index');
    Route::get('/gestion-organizacional/pdf', 'GestionOrganizacionalReportController@pdf');
    Route::get('/gestion-organizacional/html', 'GestionOrganizacionalReportController@html');

    // Route::get('/importar/ciudades', 'PaisController@index');
    // Route::post('/proceso/upsert', 'ProcesoController@upsert');
    // Route::post('/proceso/upload', 'ProcesoController@uploadFile');
    // Route::post('/proceso/upload/delete', 'ProcesoController@deleteFile');
    // Route::post('/proceso/tipo-proceso/documentos', 'ProcesoController@getDocumentosTipoProceso');
    // Route::post('/proceso/delete/{id}', 'ProcesoController@delete');
    // Route::post('/proceso/{id}', 'ProcesoController@get');



});

Route::middleware('no-auth')->group(function () {
    Route::get('/login', 'AuthController@index')->name('login');
    Route::post('/login', 'AuthController@login');
});

Route::post('/error/submit', 'ErrorLogController@submit');
