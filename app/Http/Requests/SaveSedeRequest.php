<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SaveSedeRequest extends FormRequest
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
            't_sede' => 'required|min:3',
            'n_idciudad' => 'required',
            
        ];
    }

    public function messages(){

        return [
            't_sede.required' => "No has ingresado el nombre de la Sede",
            't_sede.min' => "El Nombre de la Sede debe tener el menos 3 caracteres",
            
            'n_idciudad.required' => "No has seleccionado la Ciudad"
         ];
    }
}



