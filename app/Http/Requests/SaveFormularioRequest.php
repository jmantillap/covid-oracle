<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SaveFormularioRequest extends FormRequest
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
            'n_idusuario' => 'required',
            't_consentimiento' => 'required',
            'n_idsede' => 'required',           
            't_irahoy' => 'required',
            't_sitios' => 'sometimes',
            't_actividades' => 'sometimes',
            't_presentadofiebre' => 'required',
            't_diasfiebre' => 'min:0|max:200|sometimes',
            't_dolorgarganta' => 'required',
            't_malestargeneral' => 'required',
            't_secresioncongestionnasal' => 'required',
            't_dificultadrespirar' => 'required',
            't_tosseca' => 'required',
            't_personalsalud' => 'required', 
            't_contactopersonasinfectadas' => 'required_if:t_personalsalud,==,NO',
            'd_ultimocontacto' => 'sometimes',
            't_realizoviaje'=>'required',
            'd_ultimoviaje' => 'sometimes',
            't_activo' => 'required',
            't_perdolfa' => 'required',       
            't_molestia_diges'=> 'required',
            't_sigue_aislado'=> 'required',
            't_esquema_vacunacion' => 'nullable|sometimes',            
            /* 'n_iddesactiva' => 'required', */
        ];
    }



    public function messages(){

        return [
            'n_idusuario.required' => "No ha selecionado la persona",            
            't_consentimiento.required' => "No has dado el consentimiento (Preg. 1)",
            'n_idsede.required' => "No has seleccionado a la sede a la cual se dirige (Preg. 2)",
            't_irahoy.required' => "Debe responder si ira hoy a la Universidad (Preg. 3)",
            't_sitios.sometimes' => 'Debe responder a que sitios se dirige (Preg. 4)',
            't_actividades.sometimes' => 'Debe responder que actividades va a realizar (Preg. 5)',
            't_presentadofiebre.required' => "No has respondido si presento fiebre (Preg. 6)",
            't_dolorgarganta.required' => "No respondió a la pregunta sobre el dolor de garganta (Preg. 8)",
            't_malestargeneral.required' => "No has respondido sobre el malestar general (Preg. 10)",
            't_secresioncongestionnasal.required' => "No has respondido acerca de la Cosgentión Nasal (Preg. 11)",
            't_dificultadrespirar.required' => "No has Respondido acerca de la dificultad al respirar (Preg. 12)",
            't_tosseca.required' => "No has Respondido acerca de la tos seca (Preg. 13)",
            't_personalsalud.required' => "No has Respondido acerca de si es personal de salud (Preg. 15)",
            't_contactopersonasinfectadas.required_if' => "No has Respondido acerca de la cercanía con personas infectadas (Preg. 16)",            
            't_realizoviaje.required'=>'Realizó Viaje no ha sido respondido (Preg. 18)',
            't_perdolfa.required'=>'No has respondido pérdida del sentido del gusto o olfato (Preg. 9)',
            't_molestia_diges.required'=>'No has respondido sobre diarrea u otra molestia disgestiva (Preg. 14)',
            't_sigue_aislado.required'=>'No has respondido sobre aislamiento por COVID-19 (Preg. 20)',
         ];
    }
}



