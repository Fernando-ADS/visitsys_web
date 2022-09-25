<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PacienteController;
use App\Http\Controllers\AgendamentoController;
use App\Http\Controllers\VisitaController;
use App\Http\Controllers\VisitanteController;
use App\Http\Controllers\RecepcionistaController;
use App\Http\Controllers\CoordenadorController;
use App\Http\Controllers\UserController;
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
})->middleware('auth');



/*
Route::get('/mail', function () {
  Mail::send('email.visitaConfirmada', ['curso'=>'Eloquent'], function($mensagem) use ($email_visitante){
    $mensagem->from('visitsys.gestao@gmail.com','VisitSys | Gestão Hospitalar');
    $mensagem->to($email_visitante);
    $mensagem->subject('Resultado do Agendamento');
  });
});
*/
/*
Route::get('/maile', function () {
    return view('email.visitaConfirmada');
});


Route::get('/qrcode', function () {
    return view('qrcode');
});
*/


Route::get('/sobre', function () {
    return view('sobre');
})->middleware('auth');

Route::get('/faleconosco', function () {
    return view('faleconosco');
})->middleware('auth');

Route::get('/meuperfil', function () {
    return view('meuperfil');
})->middleware('auth');

Route::get('users/search', [App\Http\Controllers\UserController::class, 'search'])->name('users.search')->middleware(['auth','check.is.admin']);
Route::resource('users', UserController::class)->middleware(['auth','check.is.admin']);

Route::get('pacientes/search', [App\Http\Controllers\PacienteController::class, 'search'])->name('pacientes.search')->middleware(['auth','check.is.admin']);
Route::resource('pacientes', PacienteController::class)->middleware(['auth','check.is.admin']);

Route::get('visitantes/search', [App\Http\Controllers\VisitanteController::class, 'search'])->name('visitantes.search')->middleware(['auth','check.is.admin']);
Route::resource('visitantes', VisitanteController::class)->middleware(['auth','check.is.admin']);

Route::get('recepcionistas/search', [App\Http\Controllers\RecepcionistaController::class, 'search'])->name('recepcionistas.search')->middleware(['auth','check.is.admin']);
Route::resource('recepcionistas', RecepcionistaController::class)->middleware(['auth','check.is.admin']);

Route::get('coordenadors/search', [App\Http\Controllers\CoordenadorController::class, 'search'])->name('coordenadors.search')->middleware(['auth','check.is.admin']);
Route::resource('coordenadors', CoordenadorController::class)->middleware(['auth','check.is.admin']);

Route::get('agendamentos/search', [App\Http\Controllers\AgendamentoController::class, 'search'])->name('agendamentos.search')->middleware('auth');
Route::resource('agendamentos', AgendamentoController::class)->middleware('auth');
Route::post('agendamentos/procuraPaciente', [App\Http\Controllers\AgendamentoController::class, 'procuraPaciente'])->name('agendamentos.procuraPaciente')->middleware('auth');
Route::post('agendamentos/procuraVisitante', [App\Http\Controllers\AgendamentoController::class, 'procuraVisitante'])->name('agendamentos.procuraVisitante')->middleware('auth');


Route::get('visitas/search', [App\Http\Controllers\VisitaController::class, 'search'])->name('visitas.search')->middleware(['auth','check.is.admin']);
Route::resource('visitas', VisitaController::class)->middleware(['auth','check.is.admin']);

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home')->middleware('auth');
