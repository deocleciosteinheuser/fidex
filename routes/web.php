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

    Route::get('/consultas/usuario/{dados}', [ConsultaUsuarioController::class, 'dados'])->name('usuario.dados');
    Route::get('/consultas/geo/{dados}', [ConsultaGeoController::class, 'dados'])->name('geo.dados');
    Route::get('/consultas/categoria/{dados}', [ConsultaCategoriaController::class, 'dados'])->name('categoria.dados');
    Route::get('/consultas/periodo/{dados}', [ConsultaPeriodoController::class, 'dados'])->name('periodo.dados');
    Route::get('/consultas/sistema/{dados}', [ConsultaSistemaController::class, 'dados'])->name('sistema.dados');
    Route::get('/consultas/cliente/{dados}', [ConsultaClienteController::class, 'dados'])->name('cliente.dados');
    Route::get('/consultas/unidade/{dados}', [ConsultaUnidadeController::class, 'dados'])->name('unidade.dados');
    Route::get('/consultas/servidor/{dados}', [ConsultaServidorController::class, 'dados'])->name('servidor.dados');

    Route::get('/consultas/usuario'        , [ConsultaUsuarioController::class, 'index'])->name('consultas.usuario');
    Route::get('/consultas/geo'        , [ConsultaGeoController::class, 'index'])->name('consultas.geo');
    Route::get('/consultas/categoria'        , [ConsultaCategoriaController::class, 'index'])->name('consultas.categoria');
    Route::get('/consultas/periodo'        , [ConsultaPeriodoController::class, 'index'])->name('consultas.periodo');
    Route::get('/consultas/sistema'        , [ConsultaSistemaController::class, 'index'])->name('consultas.sistema');
    Route::get('/consultas/cliente'        , [ConsultaClienteController::class, 'index'])->name('consultas.cliente');
    Route::get('/consultas/unidade'        , [ConsultaUnidadeController::class, 'index'])->name('consultas.unidade');
    Route::get('/consultas/servidor'        , [ConsultaServidorController::class, 'index'])->name('consultas.servidor');

    Route::get('/cards/usuario'    , [DashboardController::class, 'usuario'])->name('cards.usuario');
    Route::get('/cards/geo'        , [DashboardController::class, 'geo'])->name('cards.geo');
    Route::get('/cards/categoria'  , [DashboardController::class, 'categoria'])->name('cards.categoria');
    Route::get('/cards/periodo'    , [DashboardController::class, 'periodo'])->name('cards.periodo');
    Route::get('/cards/sistema'    , [DashboardController::class, 'sistema'])->name('cards.sistema');
    Route::get('/cards/cliente'    , [DashboardController::class, 'cliente'])->name('cards.cliente');
    Route::get('/cards/unidade'    , [DashboardController::class, 'unidade'])->name('cards.unidade');
    Route::get('/cards/servidor'   , [DashboardController::class, 'servidor'])->name('cards.servidor');

    Route::get('/dashboard/nps', [DashboardController::class, 'index'])->name('dashboard.nps');
    Route::get('/dashboard/mrr', [DashboardController::class, 'index'])->name('dashboard.mrr');

});
