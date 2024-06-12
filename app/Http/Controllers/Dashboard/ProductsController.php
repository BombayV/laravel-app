<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Cliente;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Inertia\Response;

class ProductsController extends Controller
{
  public function create(Request $request): Response
  {
    return Inertia::render('Dashboard/Products/Index', [
      'status' => session('status'),
      'data' => Cliente::all(),
      'product_type' => []
    ]);
  }
}
