<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\GalaoController;
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

Route::get('/', [GalaoController::class, 'index'])->name('enviar_informacoes');
Route::post('/calcular', [GalaoController::class, 'calcular'])->name('calcular');
Route::get('/ver-resultados', [GalaoController::class, 'verResultados'])->name('ver_resultados');
Route::get('/exportar-resultados', [GalaoController::class , 'exportarResultados'])->name('exportar_resultados');

