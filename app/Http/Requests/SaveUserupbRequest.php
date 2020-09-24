<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SaveUserupbRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true; //tRUE CUALQUIER USUARIO PUEDE CREAR UN PROYECTO
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [

            't_apellidos' => 'required',
            't_nombres' => 'required',
            'c_codtipo' => 'required',           
            't_documento' => 'required|unique:users',//|numeric
            't_idsigaa' => 'sometimes',
            't_email' => 'email|required_with:t_emailc|same:t_emailc',
            'n_idsede' => 'required',
            't_telefono' => 'required',
            't_jefeinmediatocontacto' => 'sometimes',
            't_facultadareaempresa' => 'sometimes',
            'n_idvinculou' => 'required',
            't_activo' => 'required',
            't_sigaa' => 'required'
        ];
    }



    public function messages(){

        return [
            //'t_nombres.min' => "El Nombre del Docente debe tener el menos 3 caracteres",
            //'t_nombres.max' => "El Nombre del  Docente debe tener máximo 100 caracteres",
            't_apellidos.required' => "No has Ingresado el apellido",
            't_apellidos.required' => "No has Ingresado el Nombre",
            'c_codtipo.required' => "Debe seleccionar el Tipo Documento",
            't_documento.unique' => "Ya se ha ingresado ese documento",
            't_documento.required_with' => "No has ingresado el Número de Documento",
            't_email.required_with' => "No has ingresado el Email o la confirmación",
            't_email.same'=>"El email y su confirmación no son iguales",
            'n_idsede.required' => "No ha seleccionado la sede",
            't_telefono.required' => "Debe ingresar el Número telefónico o Celular",
            't_jefeinmediatocontacto.sometimes' => "Debe ingresar el Nombre del Jefe inmediato o el contacto",
            't_facultadareaempresa.sometimes' => "Debe ingresar el área la facultad y la empresa",
            'n_idvinculou.required' => "Debe seleccionar un vínculo con la Universidad",
            't_sigaa.required' => "No has Ingresado la bandera sigaa",
           
         ];
    }
}



