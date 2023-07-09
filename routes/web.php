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

Auth::routes();

Route::group(['middleware' => ['role:administrador']], function () {
    //rutas accesibles solo para clientes
    Route::resource('users', App\Http\Controllers\UserController::class);
    Route::resource('recomendaciones', App\Http\Controllers\RecomendacionesController::class);
    // Route::resource('personas', App\Http\Controllers\PersonasController::class);
    Route::resource('alerts', App\Http\Controllers\AlertasController::class);
    Route::resource('categoria-ingreso', App\Http\Controllers\CategoriaIngresoController::class);
    Route::resource('categoria-egreso', App\Http\Controllers\CategoriaEgresosController::class);
});
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::resource('ingresos', App\Http\Controllers\IngresosController::class);