<?php

use App\Http\Controllers\Api\DadosNpsController;
use App\Http\Controllers\Api\PessoaController;
use App\Http\Controllers\Api\UnidadeSistemaController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::apiResource('dadosnps', DadosNpsController::class, ['only' => 'store']);
Route::apiResource('unidade/sistema', UnidadeSistemaController::class, ['only' => 'store']);
Route::apiResource('pessoa', PessoaController::class);

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

