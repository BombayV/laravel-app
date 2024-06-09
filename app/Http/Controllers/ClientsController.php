<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Inertia;
use Inertia\Response;
use Illuminate\Support\Facades\Route;

class ClientsController extends Controller
{
    /**
     * Display the user's profile form.
     */
    public function create(Request $request): Response
    {
        return Inertia::render('Dashboard/Clients/Index', [
          'status' => session('status'),
        ]);
    }
}
