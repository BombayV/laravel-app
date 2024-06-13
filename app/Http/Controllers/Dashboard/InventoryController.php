<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Inertia\Response;

class InventoryController extends Controller
{
  public function create(Request $request): Response
  {
    return Inertia::render('Dashboard/Inventory/Index', [
      'status' => session('status'),
    ]);
  }
}
