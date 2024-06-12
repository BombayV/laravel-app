<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Dashboard\ClientsController;
use App\Http\Controllers\Dashboard\ProductsController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

Route::get('/', function () {
    return Inertia::render('Login', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
    ]);
})->middleware('guest')->name('login');

Route::get('/dashboard', function () {
    return Inertia::render('Dashboard/Dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::middleware('auth')->group(function () {
    Route::get('/dashboard/clientes', [ClientsController::class, 'create'])->name('clientes');
    Route::post('/dashboard/clientes', [ClientsController::class, 'store'])->name('clientes.store');
    Route::put('/dashboard/clientes', [ClientsController::class, 'update'])->name('clientes.update');
    Route::delete('/dashboard/clientes/{id}', [ClientsController::class, 'destroy'])->name('clientes.destroy');
    Route::get('/dashboard/clientes/{id}', [ClientsController::class, 'show'])->name('clientes.show');
    Route::delete('/dashboard/clientes', [ClientsController::class, 'all'])->name('clientes.destroy.all');
});

Route::middleware('auth')->group(function () {
    Route::get('/dashboard/productos', [ProductsController::class, 'create'])->name('productos');
    Route::post('/dashboard/productos', [ProductsController::class, 'store'])->name('productos.store');
});

Route::middleware('auth')->group(function () {
    Route::get('/dashboard/inventario', [ClientsController::class, 'create'])->name('inventario');
});

Route::middleware('auth')->group(function () {
    Route::get('/dashboard/pedidos', [ClientsController::class, 'create'])->name('pedidos');
});

Route::middleware('auth')->group(function () {
    Route::get('/dashboard/ventas', [ClientsController::class, 'create'])->name('ventas');
});

Route::middleware('auth')->group(function () {
    Route::get('/dashboard/facturas', [ClientsController::class, 'create'])->name('facturas');
});

Route::middleware('auth')->group(function () {
    Route::get('/dashboard/reportes', [ClientsController::class, 'create'])->name('reportes');
});


require __DIR__.'/auth.php';
