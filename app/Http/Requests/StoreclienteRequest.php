<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class StoreclienteRequest extends FormRequest
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
            'cli_nom' => 'required|string',
            'cli_ape' => 'required|string',
            'cli_tel' => 'required|string',
            'cli_ema' => 'required|email',
            'cli_dir' => 'required|string',
            'cli_sex' => 'required|string',
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
