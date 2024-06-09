<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ClienteController;

Route::middleware('auth')->group(function () {
  Route::get('/api', function (Request $request) {
    return $request->user();
  });
  Route::post('/api/clientes', [ClienteController::class, 'store'])->name('clientes.store');

  Route::apiResource('/clientes', ClienteController::class);
});
