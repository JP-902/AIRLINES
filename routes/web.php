<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ClienteController;
use App\Http\Controllers\BodegaController;
use App\Http\Controllers\CategoriaController;
use App\Http\Controllers\EmpleadoController;
use App\Http\Controllers\ProductoController;
use App\Http\Controllers\PedidoController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

route::get('/clientes', [App\Http\Controllers\ClienteController::class, 'index'])->name('clientes.index');

route::post('/clientes', [App\Http\Controllers\ClienteController::class, 'store',])->name('clientes.store');

route::delete('/clientes/{id}', [App\Http\Controllers\ClienteController::class, 'destroy',])->name('clientes.destroy');

route::put('/clientes/{id}', [App\Http\Controllers\ClienteController::class, 'update',])->name('clientes.update');


Route::resource('bodegas', BodegaController::class);

Route::resource('categorias', CategoriaController::class);

Route::resource('empleados', EmpleadoController::class);

Route::resource('productos', ProductoController::class);

Route::resource('pedidos', PedidoController::class);

require __DIR__.'/auth.php';
