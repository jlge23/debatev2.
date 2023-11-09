<?php

use App\Http\Controllers\DificultadeController;
use App\Http\Controllers\EquipoController;
use App\Http\Controllers\EventoController;
use App\Http\Controllers\TipoController;
use App\Http\Controllers\PreguntaController;
use App\Http\Controllers\JuegoController;
use App\Http\Controllers\InformeController;
use Illuminate\Support\Facades\Auth;
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
    return view('welcome');
});
Auth::routes();

Route::group(['middleware' => 'auth'], function () {
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/dificultad',[DificultadeController::class,'index'])->name('dificultad.index');
Route::get('/dificultad/nuevo',[DificultadeController::class,'create'])->name('dificultad.create');
Route::post('/dificultad',[DificultadeController::class,'store'])->name('dificultad.store');
Route::get('/dificultad/{id}/editar',[DificultadeController::class, 'edit'])->name('dificultad.edit');
Route::put('/dificultad',[DificultadeController::class,'update'])->name('dificultad.update');
Route::delete('/dificultad/{id}',[DificultadeController::class,'destroy'])->name('dificultad.destroy');

Route::get('equipo',[EquipoController::class,'index'])->name('equipo.index');
Route::get('equipo/nuevo',[EquipoController::class,'create'])->name('equipo.create');
Route::post('equipo',[EquipoController::class,'store'])->name('equipo.store');
Route::get('equipo/{id}/editar',[EquipoController::class, 'edit'])->name('equipo.edit');
Route::put('equipo',[EquipoController::class,'update'])->name('equipo.update');
Route::delete('equipo/{id}',[EquipoController::class,'destroy'])->name('equipo.destroy');

Route::get('evento',[EventoController::class,'index'])->name('evento.index');
Route::get('evento/nuevo',[EventoController::class,'create'])->name('evento.create');
Route::post('evento',[EventoController::class,'store'])->name('evento.store');
Route::get('evento/{id}/editar',[EventoController::class, 'edit'])->name('evento.edit');
Route::put('evento',[EventoController::class,'update'])->name('evento.update');
Route::delete('evento/{id}',[EventoController::class,'destroy'])->name('evento.destroy');

Route::get('tipo',[TipoController::class,'index'])->name('tipo.index');
Route::get('tipo/nuevo',[TipoController::class,'create'])->name('tipo.create');
Route::post('tipo',[TipoController::class,'store'])->name('tipo.store');
Route::get('tipo/{id}/editar',[TipoController::class, 'edit'])->name('tipo.edit');
Route::put('tipo',[TipoController::class,'update'])->name('tipo.update');
Route::delete('tipo/{id}',[TipoController::class,'destroy'])->name('tipo.destroy');

Route::get('pregunta',[PreguntaController::class,'index'])->name('pregunta.index');
Route::get('pregunta/nuevo',[PreguntaController::class,'create'])->name('pregunta.create');
Route::get('pregunta/{id}',[PreguntaController::class,'numero'])->name('pregunta.numero');
Route::post('pregunta',[PreguntaController::class,'store'])->name('pregunta.store');
Route::get('pregunta/{id}/editar',[PreguntaController::class, 'edit'])->name('pregunta.edit');
Route::put('pregunta/update/{id}',[PreguntaController::class,'update'])->name('pregunta.update');
Route::delete('pregunta/{id}',[PreguntaController::class,'destroy'])->name('pregunta.destroy');

Route::get('juego',[JuegoController::class,'index'])->name('juego.index');
Route::get('juego/reset',[JuegoController::class,'reset'])->name('juego.reset');
Route::get('juego/demo/{demo}',[JuegoController::class,'demo'])->name('juego.demo');
Route::get('perder/{r}/{e}',[JuegoController::class,'perder'])->name('perder');
Route::get('anular/{preg}',[JuegoController::class,'anular'])->name('anular');
Route::get('juego/dificultad',[JuegoController::class,'dificultad'])->name('juego.dificultad');
Route::get('juego/{id}/preguntas/',[JuegoController::class,'preguntas'])->name('juego.preguntas');
Route::get('juego/equipos',[JuegoController::class,'findEquipos'])->name('juego.findEquipos');
Route::post('juego',[JuegoController::class,'store'])->name('juego.store');
Route::get('juego/{e}/{d}',[JuegoController::class, 'edit'])->name('juego.edit');
Route::put('juego',[JuegoController::class,'update'])->name('juego.update');
Route::delete('juego/{id}',[JuegoController::class,'destroy'])->name('juego.destroy');

Route::get('informe',[InformeController::class,'index'])->name('informe.index');
Route::get('informe/grafico/{grafico}',[InformeController::class,'graficos'])->name('informe.grafico');
Route::get('informe/resultados',[InformeController::class,'resultados'])->name('informe.resultados');
});
