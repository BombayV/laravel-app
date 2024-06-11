<?php

namespace App\Http\Requests;

use App\Models\Cliente;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Inertia\Inertia;

class StoreClienteRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'nombre' => 'required|string|max:30',
            'apellido' => 'required|string|max:30',
            'telefono' => 'required|string|max:10|min:10|regex:/^[0-9]+$/',
            'email' => 'required|email|max:50|lowercase',
            'direccion' => 'required|string|max:100',
            'sexo' => 'required|string|max:1|in:M,F,O',
        ];
    }

    public function failedValidation(Validator $validator)
    {
      return Inertia::render('Dashboard/Clients/Index', [
        'status' => session('status'),
      ]);
    }
}
