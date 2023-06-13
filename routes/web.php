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

Route::get('/', function () {
    
   
    return view('auth.login');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');


Route::resource('unidadmedidas', App\Http\Controllers\UnidadmedidaController::class)->middleware('auth');

Route::resource('parroquias', App\Http\Controllers\ParroquiaController::class)->middleware('auth');
Route::resource('municipios', App\Http\Controllers\MunicipioController::class)->middleware('auth');
Route::resource('estados', App\Http\Controllers\EstadoController::class)->middleware('auth');

//reportes
Route::get('gabinetes/reportes', [App\Http\Controllers\GabineteController::class, 'reportes'])->name('gabinetes.reportes')->middleware('auth');
Route::post('gabinetes/reporte_pdf', [App\Http\Controllers\GabineteController::class, 'reporte_pdf'])->name('gabinetes.reporte_pdf')->middleware('auth');
Route::resource('gabinetes', App\Http\Controllers\GabineteController::class)->middleware('auth');

//reportes
Route::get('corporaciones/reportes', [App\Http\Controllers\CorporacioneController::class, 'reportes'])->name('corporaciones.reportes')->middleware('auth');
Route::post('corporaciones/reporte_pdf', [App\Http\Controllers\CorporacioneController::class, 'reporte_pdf'])->name('corporaciones.reporte_pdf')->middleware('auth');
Route::resource('corporaciones', App\Http\Controllers\CorporacioneController::class)->middleware('auth');

//reportes
Route::get('responsables/reportes', [App\Http\Controllers\ResponsableController::class, 'reportes'])->name('responsables.reportes')->middleware('auth');
Route::post('responsables/reporte_pdf', [App\Http\Controllers\ResponsableController::class, 'reporte_pdf'])->name('responsables.reporte_pdf')->middleware('auth');
Route::resource('responsables', App\Http\Controllers\ResponsableController::class)->middleware('auth');

//reportes
Route::get('proyectos/reportes', [App\Http\Controllers\ProyectoController::class, 'reportes'])->name('proyectos.reportes')->middleware('auth');
Route::post('proyectos/reporte_pdf', [App\Http\Controllers\ProyectoController::class, 'reporte_pdf'])->name('proyectos.reporte_pdf')->middleware('auth');
Route::resource('proyectos', App\Http\Controllers\ProyectoController::class)->middleware('auth');

//reportes
Route::get('direcciones/reportes', [App\Http\Controllers\DireccioneController::class, 'reportes'])->name('direcciones.reportes')->middleware('auth');
Route::post('direcciones/reporte_pdf', [App\Http\Controllers\DireccioneController::class, 'reporte_pdf'])->name('direcciones.reporte_pdf')->middleware('auth');
Route::resource('direcciones', \App\http\Controllers\DireccioneController::class)->middleware('auth');

Route::resource('users', \App\Http\Controllers\UserController::class)->middleware('auth');

//reportes
Route::get('actividades/reportes', [App\Http\Controllers\ActividadeController::class, 'reportes'])->name('actividades.reportes')->middleware('auth');
Route::post('actividades/reporte_pdf', [App\Http\Controllers\ActividadeController::class, 'reporte_pdf'])->name('actividades.reporte_pdf')->middleware('auth');
Route::resource('actividades', \App\Http\Controllers\ActividadeController::class)->middleware('auth');
