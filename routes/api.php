<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ClienteController;

Route::get('/api', function (Request $request) {
    return $request->user();
});

Route::apiResource('/clientes', ClienteController::class);
