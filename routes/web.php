<?php

use App\Http\Controllers\catalogo\CategoriaController;
use App\Http\Controllers\catalogo\CursoControler;
use App\Http\Controllers\cursos\ExamenCursoController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ReporteController;
use App\Http\Controllers\seguridad\PermissionController;
use App\Http\Controllers\seguridad\RolController;
use App\Http\Controllers\seguridad\UserController;
use App\Http\Controllers\WelcomeController;
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

//Route::get('/', [WelcomeController::class, 'index']);
Route::get('/', [HomeController::class, 'redirectToLogin']);

//Route::get('/public/index', 'WelcomeController@index');

Auth::routes();

Route::get('/home', [HomeController::class, 'index'])->name('home');
Route::post('upload_audio', [HomeController::class, 'upload_audio'])->name('upload_audio');
Route::post('delete_audio', [HomeController::class, 'delete_audio'])->name('delete_audio');
Route::post('examen_evaluar', [HomeController::class,'examen_evaluar'])->name('examen_evaluar');
Route::get('get_correcta/{codigo}', [CursoControler::class, 'get_correcta']);


//seguridad
Route::post('seguridad/usuario/update_roles', [UserController::class, 'update_roles']);
Route::get('seguridad/roles/update_permission', [RolController::class, 'update_permission']);
Route::resource('seguridad/permission', PermissionController::class);
Route::resource('seguridad/rol', RolController::class);
Route::post('seguridad/usuario/update_estado/{id}', [UserController::class,'update_estado']);
Route::post('seguridad/usuario/reset_clave/{id}', [UserController::class,'reset_clave']);
Route::resource('seguridad/usuario', UserController::class);


//catalogos
Route::resource('catalogo/categoria', CategoriaController::class);

Route::get('catalogo/curso/show_examen/{id}', [CursoControler::class,'show_examen']);
Route::post('catalogo/curso/add_examen', [CursoControler::class,'add_examen']);
Route::post('catalogo/curso/delete_tema', [CursoControler::class,'delete_tema']);
Route::post('catalogo/curso/update_tema', [CursoControler::class,'update_tema']);
Route::post('catalogo/curso/add_tema', [CursoControler::class,'add_tema']);
Route::post('catalogo/curso/delete_upload', [CursoControler::class,'delete_upload']);
Route::post('catalogo/curso/upload', [CursoControler::class,'upload']);
Route::resource('catalogo/curso', CursoControler::class);

Route::get('curso/examen/admin', [ExamenCursoController::class, 'index_admin']);
Route::get('curso/examen/get_sections_89/{id}', [ExamenCursoController::class, 'get_sections_89']);
Route::post('curso/examen/evaluate_section89', [ExamenCursoController::class,'evaluate_section89'])->name('evaluate_section89');


Route::post('curso/examen/section', [ExamenCursoController::class, 'store_section']);
Route::post('curso/examen/section8', [ExamenCursoController::class, 'store_section8']);
Route::post('curso/examen/section_final', [ExamenCursoController::class, 'store_section_final']);
Route::post('curso/examen/finalizado', [ExamenCursoController::class, 'finalizado']);
Route::get('curso/examen/section/{number}', [ExamenCursoController::class, 'show_section'])->name('curso.examen.section');
Route::resource('curso/examen', ExamenCursoController::class);
// Route::post('upload_audio', [CursoControler::class, 'upload_audio'])->name('upload_audio');
// Route::post('delete_audio', [CursoControler::class, 'delete_audio'])->name('delete_audio');


Route::get('catalogo/curso/show_examen_student/{id}', [CursoControler::class,'show_examen_student']);
Route::post('catalogo/curso/show_examen_evaluar', [CursoControler::class,'show_examen_evaluar']);
Route::get('get_correcta/{codigo}', [CursoControler::class, 'get_correcta']);
Route::get('get_examenes/{curso_id}', [CursoControler::class, 'get_examenes']);

Route::get('curso/reporte/{id}', [ReporteController::class,'index']);
