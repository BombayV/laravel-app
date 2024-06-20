<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Cliente;
use App\Models\Inventario;
use App\Models\Producto;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Inertia\Response;

class ProductsSearchController extends Controller
{
  public function show($id): \Illuminate\Http\JsonResponse
  {
    if (empty($id)) {
      return $this->sendError('No se ha ingresado un valor de búsqueda');
    }

    $name = $id;

    $result = Producto::where('pro_nom', 'like', "%$name%")
      ->whereHas('inventario', function ($query) {
        $query->where('inv_stock', '>', 0);
      })
      ->get();
    return $this->sendResponse($result, 'Productos encontrados');
  }
}
