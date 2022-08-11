<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreMedicoRequest extends FormRequest
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
            'tipo_documento_id'                    => 'required',
            'numero_identificacion'                => 'required',
            'nombre'                               => 'required',
            'apellido'                             => 'required',
            'fecha_nacimiento'                     => 'required',
            'telefono'                             => 'required',
            'email'                                => 'required',
            'password'                             => 'required',
        ];
    }

    public function attributes()
    {
        return [
            'tipo_documento_id'                    => 'nombre',
            'numero_identificacion'                => 'número de identificación',
            'nombre'                               => 'nombre',
            'apellido'                             => 'apellido',
            'fecha_nacimiento'                     => 'fecha de nacimiento',
            'telefono'                             => 'teléfono',
            'email'                                => 'email',
            'password'                             => 'contraseña',
        ];
    }

    /*public function mesagges()
    {
        return [
            'tipo_documento_id.required'                   => 'El campo tipo de documento es obligatorio.',
            'numero_identificacion.required'               => 'El número de identificación es obligatorio.',
            'nombre.required'                              => 'El campo nombre es obligatorio.',
            'apellido.required'                            => 'El campo apellido es obligatorio.',
            'fecha_nacimiento.required'                    => 'El campo fecha de nacimiento es obligatorio.',
        ];
    }*/
}
