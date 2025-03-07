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
     */
    public function rules(): array
    {
        return [
            'tejido'       => ['required', 'in:strech,popelin,jacquard,viscosa'],
            'subcategoria' => ['required', 'in:estampado,flocado,otros'],
            'gama'         => ['required', 'in:amarillo,azul,blanco,gris,marrón,morado,naranja,negro,rojo,rosa,verde'],
            'color_primario'   => ['required', 'string', 'max:7'],
            'color_secundario' => ['required', 'string', 'max:7'],
            'metros'       => ['required', 'numeric', 'min:0.01', 'max:9.99'],
            'precio_base'  => ['required', 'numeric', 'min:0', 'max:99.99', 'regex:/^\d+(\.\d{1,2})?$/'],
            'precio_retal' => ['required', 'numeric', 'min:0', 'max:99.99', 'regex:/^\d+(\.\d{1,2})?$/'],
            'estado'      => ['required', 'in:disponible,vendido'],
            'descripcion' => ['nullable', 'string', 'max:1000'],

            // Validación de archivos
            'imagenes'            => ['nullable', 'array'],
            'imagenes.*'          => ['file', 'mimes:jpg,jpeg,png', 'max:2048'], // Máximo 2MB por archivo

            'eliminar_imagenes'   => ['array'],
            'eliminar_imagenes.*' => ['integer', 'exists:retal_imagenes,id'],

            'agregar_imagenes'    => ['array'],
            'agregar_imagenes.*'  => ['file', 'mimes:jpg,jpeg,png', 'max:2048'],
        ];
    }
}
