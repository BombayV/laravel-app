<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Inventario;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Inertia\Response;

class InventoryController extends Controller
{
  public function create(Request $request): Response
  {
    return Inertia::render('Dashboard/Inventory/Index', [
      'status' => session('status'),
      'inventory' => Inventario::all()
    ]);
  }
}
