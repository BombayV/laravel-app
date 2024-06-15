<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Pedido;
use App\Models\Producto;
use Inertia\Inertia;

class OrdersController extends Controller
{
  public function create()
  {
    return Inertia::render('Dashboard/Orders/Index', [
      'status' => session('status'),
      'orders' => Pedido::with(['cliente', 'EstadoPedido', 'detallePedido.producto', 'detallePedido.producto.tipoProducto'])->get(),
    ]);
  }

  public function store()
  {

  }
}
