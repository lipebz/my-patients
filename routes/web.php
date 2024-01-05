<?php

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

Route::get('/', function () {
    return view('welcome');
});

Route::get('/pacientes', function () {
    return view('pacientes.listagem');
})->name('pacientes.listagem');

Route::get('/pacientes/cadastro', function () {
    return view('pacientes.cadastro');
})->name('pacientes.cadastro');

Route::get('/pacientes/importar-csv', function () {
    return view('pacientes.importar-csv');
})->name('pacientes.importar-csv');

Route::get('/pacientes/{id}', function (int $id) {
    return view('pacientes.detalhes', ['id'=> $id]);
})->name('pacientes.detalhes');

Route::get('/pacientes/{id}/edicao', function (int $id) {
    return view('pacientes.edicao', ['id'=> $id]);
})->name('pacientes.edicao');
