<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use Inertia\Inertia;

class ReportsController extends Controller
{
  public function create()
  {
    return Inertia::render('Dashboard/Reports/Index', [
      'status' => session('status')
    ]);
  }
}
