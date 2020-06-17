<?php

include ('web-admin.php');
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


Route::get('/', function () {
    return view('welcome');
});
Route::get('formulario/inactivar', 'FormularioController@inactivar')->name('formulario.inactivar')->middleware('auth');
Route::get('formulario/{id}/updateinac', 'FormularioController@updateinac')->name('formulario.updateinac')->middleware('auth');
Route::view('/','home', ['nombre'=>'Jairo Peña Fuentes'])->name('home');
Route::get('home/externos', 'Externos\ExternosController@homeext')->name('homeext');

Route::view('inicio','inicio', ['nombre'=>'Jairo Peña Fuentes'])->name('inicio');
//Route::resource('sedes', 'SedesController')->names('sedes')->parameters(['sedes'  =>  'sedes'])->middleware('role:1|2');
Route::resource('formulario', 'FormularioController')->names('formulario')->parameters(['formulario'  =>  'formulario']);//->middleware('role:1|2');

Route::get('formulario/create/{n_idciudad}', 'FormularioController@listarSedesAjax')->name('sedes.listar');

Route::resource('users', 'UsersController')->names('users')->parameters(['users'  =>  'users']);//->middleware('role:1|2');
Route::resource('usersupb', 'Loginupb\UsersupbController')->names('usersupb')->parameters(['users'  =>  'users']);//->
Route::resource('usuarios', 'UsuariosController')->names('usuarios')->parameters(['usuarios'  =>  'usuarios']);//->middleware('role:1|2');
Route::get('usuarios/editar/{usuarios}', 'UsuariosController@editar')->name('usuarios.editar');
Route::resource('sedes', 'SedesController')->names('sedes')->parameters(['sedes'  =>  'sedes'])->middleware('auth');;//->middleware('role:1|2');


Route::post('revisar', 'RevisarController@verificar')->name('revisar');

Route::get('reportes/reporte1', 'ReportesController@index')->name('reportes.reporte1')->middleware('auth');
Route::get('reportes/reporte2', 'ReportesController@reporte2')->name('reportes.reporte2')->middleware('auth');
Route::get('reportes/reporte3', 'ReportesController@reporte3')->name('reportes.reporte3')->middleware('auth');
Route::get('reportes/reporte4', 'ReportesController@reporte4')->name('reportes.reporte4')->middleware('auth');

/* para despues del cambio Oracle */

Route::get('/loginupb','Loginupb\LoginupbController@showLoginForm')->name('loginupb');
Route::post('/autenticarupb','Loginupb\LoginupbController@validarLogin')->name('loginupb.validar');


Route::get('losusuarios', 'UsuariosController@getListaUsuarios')->name('losusuarios');
Route::get('losformularios', 'FormularioController@getListaFormularios')->name('losformularios');
Route::get('reporteador1', 'ReportesController@getReporte1Formularios')->name('reporteador1');
Route::get('reporteador2', 'ReportesController@getReporte2Formularios')->name('reporteador2');
Route::get('reporteador3', 'ReportesController@getReporte3Formularios')->name('reporteador3');
Route::get('reporteador4', 'ReportesController@getReporte4Formularios')->name('reporteador4');


Auth::routes();