<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Cliente;
use App\Models\Producto;
use App\Models\TipoProducto;
use Inertia\Inertia;

class ReportsController extends Controller
{
  public function create()
  {
    // Count of clients created in the last 30 days
    $createdClients = Cliente::where('created_at', '>=', now()->subDays(30))->count();
    // Total count of products
    $productsCount = Producto::count();
    $productTypesCount = TipoProducto::count();
    return Inertia::render('Dashboard/Reports/Index', [
      'status' => session('status'),
      'stats' => [
        'clients' => $createdClients,
        'products' => $productsCount,
        'productTypes' => $productTypesCount,
      ],
    ]);
  }
}
