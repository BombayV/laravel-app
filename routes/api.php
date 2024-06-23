<?php

use App\Http\Controllers\api\ClientsController;
use App\Http\Controllers\api\OrdersController;
use App\Http\Controllers\api\ProductsController;
use App\Http\Controllers\api\InventoryController;
use App\Http\Controllers\api\ProductsTypesController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

Route::apiResource('clientes', ClientsController::class)->only(['index', 'store', 'show', 'update', 'destroy']);
Route::apiResource('productos', ProductsController::class)->only(['index', 'store', 'show', 'update', 'destroy']);
Route::apiResource('inventario', InventoryController::class)->only(['index', 'show', 'update']);
Route::apiResource('tiposproductos', ProductsTypesController::class)->only(['index', 'store', 'show', 'update', 'destroy']);
Route::apiResource('pedidos', OrdersController::class)->only(['index', 'store', 'show', 'update', 'destroy']);

