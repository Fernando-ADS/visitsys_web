<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PacienteController;
use App\Http\Controllers\AgendamentoController;
use App\Http\Controllers\VisitaController;
use App\Http\Controllers\VisitanteController;
use App\Http\Controllers\RecepcionistaController;
use App\Http\Controllers\CoordenadorController;
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

Route::get('/teste', function () {
    return view('teste');
});

Route::get('/sobre', function () {
    return view('sobre');
});

Route::get('/faleconosco', function () {
    return view('faleconosco');
});


Route::get('pacientes/search', [App\Http\Controllers\PacienteController::class, 'search'])->name('pacientes.search');
Route::resource('pacientes', PacienteController::class);

Route::get('visitantes/search', [App\Http\Controllers\VisitanteController::class, 'search'])->name('visitantes.search');
Route::resource('visitantes', VisitanteController::class);

Route::get('recepcionistas/search', [App\Http\Controllers\RecepcionistaController::class, 'search'])->name('recepcionistas.search');
Route::resource('recepcionistas', RecepcionistaController::class);

Route::get('coordenadors/search', [App\Http\Controllers\CoordenadorController::class, 'search'])->name('coordenadors.search');
Route::resource('coordenadors', CoordenadorController::class);

Route::get('agendamentos/search', [App\Http\Controllers\AgendamentoController::class, 'search'])->name('agendamentos.search');
Route::resource('agendamentos', AgendamentoController::class);

Route::get('visitas/search', [App\Http\Controllers\VisitaController::class, 'search'])->name('visitas.search');
Route::resource('visitas', VisitaController::class);

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
