<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;

class UpdateclienteRequest extends FormRequest
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
            'nombre' => 'required|string',
            'apellido' => 'required|string',
            'telefono' => 'required|string',
            'email' => 'required|email',
            'direccion' => 'required|string',
            'sexo' => 'required|string',
        ];
    }
    public function failedValidation(Validator $validator)
    {
      throw new HttpResponseException(response()->json(
        [
          'success' => false,
          'message' => 'Error de validación',
          'data' => $validator->errors(),
          'status' => 422

        ]));
    }
}
