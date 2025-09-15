<?php

use App\Http\Controllers\ImageToolController;
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

// Rutas para el gestor de imágenes

// Mostrar el formulario de subida y procesamiento de imágenes
Route::get('/gestor-imagen', [ImageToolController::class, 'index'])->name('gestor.imagen');

// Procesa la imagen subida
Route::post('/gestor-imagen/process', [ImageToolController::class, 'process'])->name('gestor.imagen.process');
