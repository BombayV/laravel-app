<?php

namespace App\Http\Controllers;

use App\Models\Cliente;
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
          'data' => Cliente::all(),
        ]);
    }

    public function store(Request $request): Response
    {
      $request->validate([
        'nombre' => 'required|string|max:30',
        'apellido' => 'required|string|max:30',
        'telefono' => 'required|string|max:10|min:10|regex:/^[0-9]+$/',
        'email' => 'required|email|max:50|lowercase',
        'direccion' => 'required|string|max:100',
        'sexo' => 'required|string|max:1|in:m,f,o',
      ]);

      $details =
      [
        'cli_nom' => $request->nombre,
        'cli_ape' => $request->apellido,
        'cli_tel' => $request->telefono,
        'cli_ema' => $request->email,
        'cli_dir' => $request->direccion,
        'cli_sex' => $request->sexo,
      ];

      $result = Cliente::create($details);
      return Inertia::render('Dashboard/Clients/Index', [
        'status' => session('status'),
        'result' => $result,
      ]);
    }
}
