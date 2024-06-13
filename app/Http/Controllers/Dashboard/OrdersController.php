<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use Inertia\Inertia;

class OrdersController extends Controller
{
  public function create()
  {
    return Inertia::render('Dashboard/Orders/Index', [
      'status' => session('status')
    ]);
  }
}
