<?php
/**
 * Javier Mantilla. javier.mantillap@upb.edu.co
 * 2020-06
 */
Route::get('/clear','ConfiguracionController@clear')->name('clear');

##logins
Route::get('/login','Auth\LoginController@showLoginForm')->name('login');
Route::get('/logout', 'Auth\LoginController@logout')->name('logout');
Route::post('/autenticar','Auth\LoginController@validarLogin')->name('login.validar');
Route::get('/autenticar','Auth\LoginController@irLogin');

#administradores
Route::get('/administrador/listar','Administrador\ListarAdministradorController@index')->name('administrador.listar')->middleware('auth');
Route::post('/administrador/listar','Administrador\ListarAdministradorController@seleccionar')->name('administrador.seleccionar')->middleware('auth');
Route::get('/administrador/listar/nuevo','Administrador\ListarAdministradorController@envioNuevo')->name('administrador.listar.nuevo')->middleware('auth');
Route::get('/administrador/administrador','Administrador\AdministradorController@index')->name('administrador.mostrar')->middleware('auth');
Route::post('/administrador/administrador','Administrador\AdministradorController@envioGuardar')->name('administrador.guardar')->middleware('auth');
Route::get('/administrador/login/ajax','Administrador\AdministradorController@getAdministradorAjax')->name('administrador.login.ajax')->middleware('auth');


Route::get('/perfil','Administrador\PerfilController@showPerfil')->name('administrador.perfil')->middleware('auth');
Route::post('/perfil/actualizar','Administrador\PerfilController@envioGuardarPerfil')->name('perfil.guardar')->middleware('auth'); 


Route::get('/estadistica','Estadistica\EstadisticaController@index')->name('estadistica');
Route::get('/estadistica/fiebre/grafico/ajax','Estadistica\EstadisticaController@getDatosGraficaFiebreAjax')->name('estadistica.fiebre.grafico.ajax')->middleware('auth');
Route::get('/estadistica/secrecion/grafico/ajax','Estadistica\EstadisticaController@getDatosGraficaSecrecionAjax')->name('estadistica.secrecion.grafico.ajax')->middleware('auth');
Route::get('/estadistica/viaje/grafico/ajax','Estadistica\EstadisticaController@getDatosGraficaViajeAjax')->name('estadistica.viaje.grafico.ajax')->middleware('auth');
Route::get('/estadistica/garganta/grafico/ajax','Estadistica\EstadisticaController@getDatosGraficaGargantaAjax')->name('estadistica.garganta.grafico.ajax')->middleware('auth');
Route::get('/estadistica/malestar/grafico/ajax','Estadistica\EstadisticaController@getDatosGraficaMalestarAjax')->name('estadistica.malestar.grafico.ajax')->middleware('auth');
Route::get('/estadistica/respirar/grafico/ajax','Estadistica\EstadisticaController@getDatosGraficaRepirarAjax')->name('estadistica.respirar.grafico.ajax')->middleware('auth');
Route::get('/estadistica/tos/grafico/ajax','Estadistica\EstadisticaController@getDatosGraficaTosAjax')->name('estadistica.tos.grafico.ajax')->middleware('auth');
Route::get('/estadistica/contacto/grafico/ajax','Estadistica\EstadisticaController@getDatosGraficaContactoAjax')->name('estadistica.contacto.grafico.ajax')->middleware('auth');
Route::post('/estadistica/generar/excel','Estadistica\EstadisticaController@generarExcelFormularios')->name('estadistica.generar.excel')->middleware('auth');

#ciudades
Route::get('/ciudad/listar','Ciudad\ListarCiudadController@index')->name('ciudad.listar')->middleware('auth');
Route::post('/ciudad/listar','Ciudad\ListarCiudadController@seleccionar')->name('ciudad.seleccionar')->middleware('auth');
Route::get('/ciudad/listar/nuevo','Ciudad\ListarCiudadController@envioNuevo')->name('ciudad.listar.nuevo')->middleware('auth');
Route::get('/ciudad/ciudad','Ciudad\CiudadController@index')->name('ciudad.mostrar')->middleware('auth');
Route::post('/ciudad/ciudad','Ciudad\CiudadController@envioGuardar')->name('ciudad.guardar')->middleware('auth');

