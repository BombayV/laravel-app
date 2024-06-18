<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;

use App\Models\Pedido;
use App\Models\Ventas;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Inertia\Response;

class SalesController extends Controller
{
  public function create(Request $request): Response
  {
    return Inertia::render('Dashboard/Sales/Index', [
      'status' => session('status'),
      'data' => Ventas::all()
    ]);
  }

  public function store(Request $request): Response
  {
    $request->validate([
      'pedidoId' => 'required|integer',
    ]);

    $pedido = Pedido::findOrFail($request->pedidoId);
    $pedido->update([
      'fk_est_ped_id' => $pedido->fk_est_ped_id + 1
    ]);

    // Create a new sale

    return Inertia::render('Dashboard/Sales/Index', [
      'status' => session('status'),
      'result' => [

      ]
    ]);
  }
}
