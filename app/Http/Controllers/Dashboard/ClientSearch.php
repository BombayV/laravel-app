<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Cliente;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Inertia\Response;

class ClientSearch extends Controller
{
  public function show($id): \Illuminate\Http\JsonResponse
  {
    if (empty($id)) {
      return $this->sendError('No se ha ingresado un valor de búsqueda');
    }

    $result = Cliente::where('cli_nom', 'like', "%$id%")
      ->orWhere('cli_ape', 'like', "%$id%")
      ->orWhere('cli_ema', 'like', "%$id%")
      ->get();

    return $this->sendResponse($result, 'Clientes encontrados');
  }
}
