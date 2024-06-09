<?php

namespace App\Repositories;

use App\Models\Cliente;
use App\Interfaces\ClienteRepositoryInterface;

class ClienteRepository implements ClienteRepositoryInterface
{
    public function index()
    {
        return Cliente::all();
    }

    public function getById($id)
    {
        return Cliente::findOrFail($id);
    }

    public function store(array $data)
    {
        return Cliente::create($data);
    }

    public function update(array $data, $id)
    {
        return Cliente::find($id)->update($data);
    }

    public function delete($id)
    {
        Cliente::destroy($id);
    }
}
