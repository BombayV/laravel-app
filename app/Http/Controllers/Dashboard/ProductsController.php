<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\EstadoProducto;
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
      'product_type' => TipoProducto::all(),
      'product_state' => EstadoProducto::all()
    ]);
  }

  public function show(Request $request): \Illuminate\Http\RedirectResponse
  {
    return redirect()->route('productos');
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

    return Inertia::render('Dashboard/Products/Index', [
      'status' => session('status'),
      'result' => [
        'pro_id' => $result->pro_id,
        'pro_nom' => $result->pro_nom,
        'pro_val' => $result->pro_val,
        'fk_tip_pro_id' => $result->fk_tip_pro_id,
        'fk_est_pro_id' => 1
      ]
    ]);
  }

  public function update(Request $request): Response
  {
    $request->validate([
      'nombre' => 'required',
      'valor' => 'required',
      'tipo' => 'required',
      'estado' => 'required',
    ]);

    $result = Producto::where('pro_id', $request->input('id'))->update([
      'pro_nom' => $request->input('nombre'),
      'pro_val' => $request->input('valor'),
      'fk_tip_pro_id' => $request->input('tipo'),
      'fk_est_pro_id' => $request->input('estado')
    ]);

    return Inertia::render('Dashboard/Products/Index', [
      'status' => session('status'),
      'result' => $result
    ]);
  }

  public function destroy(Request $request): Response
  {
    $request->validate([
      'id' => 'required'
    ]);

    Producto::destroy([
      'pro_id' => $request->input('id')
    ]);

    return Inertia::render('Dashboard/Products/Index', [
      'status' => session('status')
    ]);
  }

  public function all(Request $request): Response
  {
    $request->validate([
      'ids' => 'required|array'
    ]);

    for ($i = 0; $i < count($request->ids); $i++) {
      Producto::destroy([
        'pro_id' => $request->ids[$i]
      ]);
    }

    return Inertia::render('Dashboard/Products/Index', [
      'status' => session('status'),
    ]);
  }
}
