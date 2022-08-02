<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreEmpresaRequest extends FormRequest
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
            'nombre'                    => 'required|unique:empresas',
            'numero_identificacion'     => 'required',
            'email'                     => 'required|email|unique:empresas',
            'telefono'                  => 'required',
            'status'                    => 'required',
        ];
    }

    public function attributes()
    {
        return [
            'nombre'                    => 'nombre',
            'numero_identificacion'     => 'número de identificación',
            'email'                     => 'email',
            'telefono'                  => 'teléfono',
            'status'                    => 'status',
        ];
    }

    public function mesagges()
    {
        return [
            'nombre.required'                   => 'El campo nombre es obligatorio.',
            'nombre.unique'                     => 'El campo nombre ya se encuentra registrado.',
            'numero_identificacion.required'    => 'El número de identificación es obligatorio.',
            'email.required'                    => 'El email es obligatorio.',
            'email.unique'                      => 'El email ya se encuentra registrado.',
            'email.email'                       => 'Formato de email no permitido.',
            'telefono.required'                 => 'El teléfono es obligatorio.',
            'status.required'                   => 'El status es obligatorio.',
        ];
    }
}
