<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!|
*/
//Route::get('/', function () {    return view('welcome'); });
//Route::view('/','home')->name('home');

Route::middleware('auth:api')->group(function () {
    // our routes to be protected will go in here
});

Route::get('/','HomeController@index')->name('home');

Route::get('formulario/inactivar', 'FormularioController@inactivar')->name('formulario.inactivar')->middleware('auth');
Route::get('formulario/{id}/updateinac', 'FormularioController@updateinac')->name('formulario.updateinac')->middleware('auth');
Route::get('home/externos', 'Externos\ExternosController@homeext')->name('homeext');

Route::view('inicio','inicio', ['nombre'=>'Jairo Peña Fuentes'])->name('inicio');
Route::resource('formulario', 'FormularioController')->names('formulario')->parameters(['formulario'  =>  'formulario']);//->middleware('role:1|2');
Route::resource('users', 'UsersController')->names('users')->parameters(['users'  =>  'users']);//->middleware('role:1|2');

Route::resource('usersupb', 'Loginupb\UsersupbController')->names('usersupb')->parameters(['users'  =>  'users']);//->
Route::resource('usuarios', 'UsuariosController')->names('usuarios')->parameters(['usuarios'  =>  'usuarios']);//->middleware('role:1|2');
Route::get('usuarios/editar/{usuarios}', 'UsuariosController@editar')->name('usuarios.editar');
Route::resource('sedes', 'SedesController')->names('sedes')->parameters(['sedes'  =>  'sedes'])->middleware('auth');;//->middleware('role:1|2');

Route::post('revisar', 'RevisarController@verificar')->name('revisar');
Route::get('revisar', 'RevisarController@getRevisar')->name('revisar');

Route::get('reportes/reporte1', 'ReportesController@index')->name('reportes.reporte1')->middleware('auth');
Route::get('reportes/reporte2', 'ReportesController@reporte2')->name('reportes.reporte2')->middleware('auth');
Route::get('reportes/reporte3', 'ReportesController@reporte3')->name('reportes.reporte3')->middleware('auth');
Route::get('reportes/reporte4', 'ReportesController@reporte4')->name('reportes.reporte4')->middleware('auth');

/* para despues del cambio Oracle */
Route::get('/loginupb','Loginupb\LoginupbController@showLoginForm')->name('loginupb');
Route::post('/autenticarupb','Loginupb\LoginupbController@validarLogin')->name('loginupb.validar');
Route::get('/autenticarupb','Loginupb\LoginupbController@showLoginForm')->name('loginupb.mostrar');
Route::resource('formularioupb', 'Loginupb\FormularioupbController')->names('formularioupb')->parameters(['formulario'  =>  'formulario']);//->middleware('role:1|2');
Route::get('formularioupbshow2/{id}', 'Loginupb\FormularioupbController@show2')->name('formularioupb.show2');
Route::get('home/consulta', 'Consulta\ConsultaController@homeconsulta')->name('consulta');
Route::post('consultar', 'Consulta\ConsultaController@consultar')->name('consultar');
Route::get('consultar', 'Consulta\ConsultaController@consultar')->name('consultar');
/* Comunidad upb*/
Route::post('formularioupb/covid19/inactivar/ajax','Loginupb\FormularioupbController@envioInactivar')->name('formularioupb.covid19.inactivar.ajax');
/* visitante*/
Route::post('formulario/covid19/inactivar/ajax','FormularioController@envioInactivar')->name('formulario.covid19.inactivar.ajax');


Route::get('formulario/create/{n_idciudad}', 'FormularioController@listarSedesAjax')->name('sedes.listar');
Route::get('formularioupb/create/{n_idciudad}', 'Loginupb\FormularioupbController@listarSedesAjax')->name('sedes.listar.userupb');
Route::get('users/create/{n_idciudad}', 'UsersController@listarSedesAjax')->name('sedes.listar.users');
Route::get('usersupb/create/{n_idciudad}', 'Loginupb\UsersupbController@listarSedesAjax')->name('sedes.listar.usersupb');

Route::get('losusuarios', 'UsuariosController@getListaUsuarios')->name('losusuarios');
Route::get('losformularios', 'FormularioController@getListaFormularios')->name('losformularios');
Route::get('reporteador1', 'ReportesController@getReporte1Formularios')->name('reporteador1');
Route::get('reporteador2', 'ReportesController@getReporte2Formularios')->name('reporteador2');
Route::get('reporteador3', 'ReportesController@getReporte3Formularios')->name('reporteador3');
Route::get('reporteador4', 'ReportesController@getReporte4Formularios')->name('reporteador4');
Route::get('estado/salud', 'Reportes\ReporteEstadoSaludController@index')->name('reportes.estado.salud')->middleware('auth');
Route::post('/estado/salud/generar/excel','Reportes\ReporteEstadoSaludController@generarExcelEstadoSalud')->name('reporte.estadosalud.generar.excel')->middleware('auth');

Route::get('estado/salud/datos', 'Reportes\ReporteEstadoSaludDatosController@index')->name('reportes.estado.salud.datos')->middleware('auth');
Route::post('/estado/salud/datos/generar/excel','Reportes\ReporteEstadoSaludDatosController@generarExcelEstadoSaludDatos')->name('reporte.estadosalud.datos.generar.excel')->middleware('auth');

Route::get('/salir/usuario/upb','Loginupb\LoginupbController@cerrarSessionUserUPB')->name('salir.usuario.upb');
Route::get('/salir/usuario/visitante','Loginupb\LoginupbController@cerrarSessionUserUPB')->name('salir.usuario.visitante');

/*Funcionalidad de acta*/
Route::get('/acta/usuario/','Formularioacta\FormularioActaController@index')->name('acta.usuario.upb');
Route::post('/acta/usuario/','Formularioacta\FormularioActaController@envioGuardar')->name('acta.usuario.guardar');

/*Funcionalidad de inactivar formularios de encuesta covid */
Route::get('acta/covid19/inactivar', 'Formularioacta\ActaCovidInactivarController@index')->name('acta.covid19.inactivar')->middleware('auth');
Route::get('acta/covid19/consultar', 'Formularioacta\ActaCovidInactivarController@consultar')->name('acta.covid19.consultar.ajax')->middleware('auth');
Route::post('acta/covid19/inactivar/ajax','Formularioacta\ActaCovidInactivarController@envioInactivar')->name('acta.covid19.inactivar.ajax')->middleware('auth');

/** Funcionalidad de encuesta cormobilidad */
Route::get('/encuesta/comorbilidad/','Formulariocomorbilidad\FormularioCormobilidadController@index')->name('encuesta.comorbilidad.upb');
Route::post('/encuesta/comorbilidad/','Formulariocomorbilidad\FormularioCormobilidadController@envioGuardar')->name('encuesta.comorbilidad.upb.guardar');

/*Funcionalidad de inactivar Encuesta comorbilidad */
Route::get('encuesta/comorbilidad/inactivar', 'Formulariocomorbilidad\ComorbilidadInactivarController@index')->name('encuesta.comorbilidad.inactivar')->middleware('auth');
Route::get('encuesta/comorbilidad/consultar', 'Formulariocomorbilidad\ComorbilidadInactivarController@consultar')->name('encuesta.comorbilidad.consultar.ajax')->middleware('auth');
Route::post('encuesta/comorbilidad/inactivar/ajax','Formulariocomorbilidad\ComorbilidadInactivarController@envioInactivar')->name('encuesta.comorbilidad.inactivar.ajax')->middleware('auth');

Route::get('encuesta/comorbilidad/actualizar', 'Formulariocomorbilidad\ComorbilidadActualizarController@index')->name('encuesta.comorbilidad.actualizar')->middleware('auth');
Route::get('encuesta/comorbilidad/actualizar/consultar', 'Formulariocomorbilidad\ComorbilidadActualizarController@consultar')->name('encuesta.comorbilidad.actualizar.consultar.ajax')->middleware('auth');
Route::post('encuesta/comorbilidad/actualizar/ajax','Formulariocomorbilidad\ComorbilidadActualizarController@envioActualizar')->name('encuesta.comorbilidad.actualizar.ajax')->middleware('auth');
Route::get('encuesta/comorbilidad/actualizar/consultar/diaria', 'Formulariocomorbilidad\ComorbilidadActualizarController@consultarEncuestaDiaria')->name('encuesta.comorbilidad.consultar.diaria.ajax')->middleware('auth');

Route::get('encuesta/diaria/empleado', 'Reportes\ReporteEncuestaEmpleadoController@index')->name('reportes.encuestadiaria.empleados')->middleware('auth');
Route::post('/encuesta/diaria/empleado/excel','Reportes\ReporteEncuestaEmpleadoController@generarExcelDiariaEmpleado')->name('reporte.generarExcelDiariaEmpleado.generar.excel')->middleware('auth');

/*Funcionalidad de inactivar Vacunacion*/
Route::get('encuesta/vacunacion/inactivar', 'Vacunacion\InactivarVacunacionController@index')->name('encuesta.vacunacion.inactivar')->middleware('auth');
Route::get('encuesta/vacunacion/consultar', 'Vacunacion\InactivarVacunacionController@consultar')->name('encuesta.vacunacion.consultar.ajax')->middleware('auth');
Route::post('encuesta/vacunacion/inactivar/ajax','Vacunacion\InactivarVacunacionController@envioInactivar')->name('encuesta.vacunacion.inactivar.ajax')->middleware('auth');

Route::get('reporte/vacunacion/empleado', 'Reportes\ReporteVacunacionController@index')->name('reportes.vacunacion.empleados')->middleware('auth');
Route::post('/reporte/vacunacion/empleado/generar/excel','Reportes\ReporteVacunacionController@generarExcelVacunacion')->name('reporte.vacunacion.generar.excel')->middleware('auth');

Route::get('/get/formulario/diario/{documento}','WsApi\ConsultasWsController@getFormularioDiario')->name('formulario.diario.documento');

include ('web-admin.php');

Auth::routes();