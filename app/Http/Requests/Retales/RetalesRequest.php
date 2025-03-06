<?php

namespace App\Http\Requests\Retales;

use Illuminate\Foundation\Http\FormRequest;

class RetalesRequest extends FormRequest
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
            'nombre' => ['required', 'string', 'min:3', 'max:255'],
            'metros' => ['required', 'numeric', 'min:0.1'],
            'precio' => ['required', 'numeric', 'min:0', 'regex:/^\d+(\.\d{1,2})?$/'],
            'image'  => ['required', 'string', 'min:3', 'max:255']
        ];
    }
}
