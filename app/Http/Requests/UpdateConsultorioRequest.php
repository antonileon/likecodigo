<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateConsultorioRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'nombre'                    => 'required',
            'telefono'                  => 'required',
            'direccion'                 => 'required',
        ];
    }

    public function attributes()
    {
        return [
            'nombre'                    => 'nombre',
            'telefono'                  => 'teléfono',
            'direccion'                 => 'dirección',
        ];
    }

    public function mesagges()
    {
        return [
            'nombre.required'                   => 'El campo nombre es obligatorio.',
            'telefono.required'                 => 'El teléfono es obligatorio.',
            'direccion.required'                => 'El campo dirección es obligatorio.',
        ];
    }
}
