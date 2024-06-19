<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use Inertia\Inertia;

class InvoiceController extends Controller
{
  public function create()
  {
    return Inertia::render('Dashboard/Invoice/Index', [
      'status' => session('status')
    ]);
  }
}
