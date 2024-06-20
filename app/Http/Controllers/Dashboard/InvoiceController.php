<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use Inertia\Inertia;
use Barryvdh\DomPDF\Facade\Pdf;

class InvoiceController extends Controller
{
  public function create()
  {
    return Inertia::render('Dashboard/Invoice/Index', [
      'status' => session('status')
    ]);
  }

  public function generate()
  {
    // Generate invoice
    $pdf = PDF::loadView('invoice');
    return $pdf->download('invoice.pdf');
  }
}
