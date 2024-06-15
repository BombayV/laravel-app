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
    request()->validate([
      'clientId' => 'required|Integer',
      'productIds' => 'required|array',
      'total' => 'required|numeric',
    ]);

    $order = Pedido::create([
      'fk_cli_id' => request('clientId'),
      'ped_tot' => request('total'),
      'fk_est_ped_id' => 1,
      'ped_fec' => date('Y-m-d H:i:s'),
    ]);

    foreach (request('productIds') as $product) {
      $order->detallePedido()->create([
        'fk_pro_id' => $product['pro_id'],
        'det_ped_can' => $product['count'],
        'det_ped_pre' => $product['pro_val'],
      ]);
    }
    $result = Pedido::with(['cliente', 'EstadoPedido', 'detallePedido.producto', 'detallePedido.producto.tipoProducto'])->where('ped_id', $order->ped_id)->first();


    return Inertia::render('Dashboard/Orders/Index', [
      'status' => session('status'),
      'result' => $result,
    ]);
  }
}
