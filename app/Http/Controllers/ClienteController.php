<?php

namespace App\Http\Controllers;

use App\Models\cliente;
use App\Http\Requests\StoreclienteRequest;
use App\Http\Requests\UpdateclienteRequest;
use App\Interfaces\ClienteRepositoryInterface;
use App\Classes\ApiResponseClass;
use App\Http\Resources\ClienteResource;
use Illuminate\Support\Facades\DB;
use Inertia\Response;

class ClienteController extends Controller
{
  private ClienteRepositoryInterface $clienteRepositoryInterface;

  public function __construct(ClienteRepositoryInterface $clienteRepositoryInterface){
    $this->clienteRepositoryInterface = $clienteRepositoryInterface;
  }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = $this->clienteRepositoryInterface->index();
      return $this->sendResponse(ClienteResource::collection($data), 'Clientes recuperados', 200);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreclienteRequest $request)
    {
        $details = [
          'cli_nom' => $request->cli_nom,
          'cli_ape' => $request->cli_ape,
          'cli_tel' => $request->cli_tel,
          'cli_ema' => $request->cli_ema,
          'cli_dir' => $request->cli_dir,
          'cli_sex' => $request->cli_sex
        ];
        DB::beginTransaction();
        try {
          $data = $this->clienteRepositoryInterface->store($details);
          DB::commit();
          return $this->sendResponse(new ClienteResource($data), 'Cliente creado');
        } catch (\Exception $e) {
          DB::rollBack();
          $this->rollback($e);
          return $this->sendError('Error al crear el cliente', [], 500);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $cliente = $this->clienteRepositoryInterface->getById($id);
        return $this->sendResponse(new ClienteResource($cliente), 'Cliente recuperado', 200);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(cliente $cliente)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateclienteRequest $request, $id)
    {
        $details = [
          'cli_nom' => $request->cli_nom,
          'cli_ape' => $request->cli_ape,
          'cli_tel' => $request->cli_tel,
          'cli_ema' => $request->cli_ema,
          'cli_dir' => $request->cli_dir,
          'cli_sex' => $request->cli_sex,
        ];
        DB::beginTransaction();
        try {
          $data = $this->clienteRepositoryInterface->update($details, $id);
          DB::commit();
          return $this->sendResponse(new ClienteResource($data), 'Cliente actualizado', 200);
        } catch (\Exception $e) {
          $this->rollback($e);
          return $this->sendError('Error al actualizar el cliente', [], 500);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        DB::beginTransaction();
        try {
          $this->clienteRepositoryInterface->delete($id);
          DB::commit();
          return $this->sendResponse([], 'Cliente eliminado', 200);
        } catch (\Exception $e) {
          $this->rollback($e);
          return $this->sendError('Error al eliminar el cliente', [], 500);
        }
    }
}
