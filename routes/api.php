<?php

use App\Http\Controllers\ApiCepService;
use App\Http\Controllers\CNSValidator;
use App\Http\Controllers\ImportacaoController;
use App\Http\Controllers\PacienteController;
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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('pacientes', [PacienteController::class, 'index']);
Route::get('pacientes/{paciente}', [PacienteController::class, 'show']);
Route::post('pacientes', [PacienteController::class, 'store']);
Route::put('pacientes/{paciente}', [PacienteController::class, 'update']);
Route::delete('pacientes/{paciente}', [PacienteController::class, 'destroy']);

Route::get('importacoes', [ImportacaoController::class, 'index']);
Route::post('importacoes', [ImportacaoController::class, 'store']);
Route::get('importacoes/{id}', [ImportacaoController::class, 'show']);
Route::post('importacoes/{id}/efetivar-importacao', [ImportacaoController::class, 'efetivarImportacao']);

Route::get('cep/{cep}', [ApiCepService::class, 'search']);
Route::get('validar/cns/{value}', [CNSValidator::class, 'validateCns']);
