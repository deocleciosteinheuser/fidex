<?php

use App\Http\Controllers\AppController;
use App\Http\Controllers\ConsultaCategoriaController;
use App\Http\Controllers\ConsultaClienteController;
use App\Http\Controllers\ConsultaController;
use App\Http\Controllers\ConsultaGeoController;
use App\Http\Controllers\ConsultaGrupoController;
use App\Http\Controllers\ConsultaPeriodoController;
use App\Http\Controllers\ConsultaServidorController;
use App\Http\Controllers\ConsultaSistemaController;
use App\Http\Controllers\ConsultaUnidadeController;
use App\Http\Controllers\ConsultaUsuarioController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\GrupoController;
use App\Http\Controllers\PessoaController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/
Route::get('/', function() {
    return redirect('/home');
});

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
    Route::get('/home', [AppController::class, 'index'])->name('home');

    Route::get('/dados/{agrupador}/{tipo}', [ConsultaController::class, 'dados'])->name('dados');

    Route::get('/consultas/{agrupador}' , [ConsultaController::class, 'index'])->name('consultas');

    Route::get('/cards/{agrupador}'    , [DashboardController::class, 'index'])->name('cards');

});


Route::get('/teste', function () {
    return view('tailwind-test');
});
