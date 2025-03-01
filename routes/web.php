<?php

use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\LoginController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\InventarioController;
use App\Http\Controllers\OrdenCompraController;

Route::get('/', function () {
    return view('auth.login');
});
Route::get('/registro', [RegisterController::class, 'showRegistrationForm'])->name('registro');
Route::post('/registro', [RegisterController::class, 'register'])->name('registro.submit');

Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class, 'login'])->name('login.submit');
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

Route::get('/inventario', [InventarioController::class, 'index'])->name('inventario');
Route::put('/inventario/actualizar', [InventarioController::class, 'actualizar'])->name('inventario.actualizar');

Route::get('/inventario/crear', [InventarioController::class, 'mostrarFormularioCreacion'])->name('inventario.crear');
Route::post('/inventario/crear', [InventarioController::class, 'crear'])->name('inventario.guardar');

Route::get('/orden-compra', [OrdenCompraController::class, 'mostrar'])->name('orden.compra');