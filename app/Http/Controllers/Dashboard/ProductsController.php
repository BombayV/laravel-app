<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Producto;
use App\Models\TipoProducto;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Inertia\Response;

class ProductsController extends Controller
{
  public function create(Request $request): Response
  {
    return Inertia::render('Dashboard/Products/Index', [
      'status' => session('status'),
      'data' => Producto::all(),
      'product_type' => TipoProducto::all()
    ]);
  }

  public function store(Request $request): Response
  {
    $request->validate([
      'nombre' => 'required',
      'valor' => 'required',
      'tipo' => 'required'
    ]);

    $result = Producto::create([
      'pro_nom' => $request->input('nombre'),
      'pro_val' => $request->input('valor'),
      'fk_tip_pro_id' => $request->input('tipo')
    ]);

    return Inertia::render('Dashboard/Clients/Index', [
      'status' => session('status'),
      'result' => $result
    ]);
  }
}
