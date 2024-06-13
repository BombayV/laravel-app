<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Inventario;
use App\Models\RegistroInventario;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Inertia\Response;

class InventoryController extends Controller
{
  public function create(Request $request): Response
  {
    return Inertia::render('Dashboard/Inventory/Index', [
      'status' => session('status'),
      'inventory' => Inventario::with('producto')->with('estadoInventario')->get(),
      'inventory_count' => Inventario::sum('inv_stock'),
      'last_30_days_entries' => RegistroInventario::where('reg_inv_fec', '>=', now()->subDays(30))->where('fk_reg_inv_tip', 1)->sum('reg_inv_can'),
      'last_30_days_exits' => RegistroInventario::where('reg_inv_fec', '>=', now()->subDays(30))->where('fk_reg_inv_tip', 2)->sum('reg_inv_can'),
    ]);
  }
}
