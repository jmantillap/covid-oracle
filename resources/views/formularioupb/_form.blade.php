@csrf

<input type="hidden" id="n_idusuario" name="n_idusuario" value="{{$n_idusuario}}">
<input type="hidden" id="t_activo" name="t_activo" value="SI">

<div class="col-md-12">
    <div class="card card-info">
        <div class="card-header">
            <h3 class="card-title">Consentimiento: <strong>{{$usuarioesta->c_codtipo}}. {{$usuarioesta->t_documento}} - {{$usuarioesta->t_nombres}} {{$usuarioesta->t_apellidos}}</strong></h3>
        </div>
        <div class="card-body">           
            {!! strip_tags(str_replace('$viculoconu',$viculoconu,Config::get('pregunta.encabezado')),'<strong><a>') !!}
            <br><br>
            <label>
                Acepto
            </label>
            <br>
            <input   type="radio" name="t_consentimiento" value="SI"  {{(old('t_consentimiento') == 'SI') ? 'checked' : ''}} required> SI &nbsp;&nbsp;&nbsp;
            <input   type="radio" name="t_consentimiento" value="NO" {{(old('t_consentimiento') == 'NO') ? 'checked' : ''}}> NO<br>            
        </div>
    </div>
</div>

<br>
<div id="dn_idciudad" class="form-group row">
    <label class="col-md-10 col-form-label">
        {{-- 1. Indique la ciudad en la cual se encuentra * --}}
        {{ Config::get('pregunta.ciudad') }} *
    </label>
    <div class="col-md-5">
        <select name="n_idciudad" class="form-control" id="n_idciudad" required>
            <option value="" >--Seleccionar Ciudad--</option>
            @foreach($ciudades as $ciudad)
                <option value="{{$ciudad->n_id }}"
                    @if ($ciudad->n_id == old('n_idciudad'))
                        selected="selected"
                    @endif                
                    >{{ $ciudad->t_nombre }}</option> 
            @endforeach
        </select>
    </div>
</div>
<div id="dn_idsede" class="form-group row">
    <label class="col-md-10 col-form-label">
        {{-- 2. Indique para cuál sede o seccional solicita el ingreso * --}}
        {{ Config::get('pregunta.sede') }} *
    </label>
    <div class="col-md-5">
        <select name="n_idsede" class="form-control" id="n_idsede" required>
            <option value="" >--Seleccionar Sede--</option>
        </select>
    </div>
</div>
<div id="dt_irahoy" class="form-group row">
    <label class="col-md-10 col-form-label">
        {{-- 3. ¿Usted irá hoy a la Universidad o a una de sus sedes? * --}}
        {{ Config::get('pregunta.ir_hoy') }} *        
    </label>
    <div class="col-md-5">
        <input   type="radio" name="t_irahoy" id="SI" value="SI" {{(old('t_irahoy') == 'SI') ? 'checked' : ''}} required> SI &nbsp;&nbsp;&nbsp;
        <input   type="radio" name="t_irahoy" id="NO" value="NO" {{(old('t_irahoy') == 'NO') ? 'checked' : ''}}> NO<br>
    </div>
</div>
<div id="lt_sitios" class="form-group row">
    <label class="col-md-10 col-form-label">
        {{-- 4. Indique el o los sitios donde realizará sus actividades * --}}
        {{ Config::get('pregunta.sitio_actividades') }} *       
    </label>
    <div class="col-md-5">
        <input class="form-control" type="text" id="t_sitios" name="t_sitios" placeholder="Indique el sitio" value="{{ old('t_sitios') }}">
    </div>
</div>
<div id="lt_actividades" class="form-group row">
    <label class="col-md-10 col-form-label">
        {{-- 5. Actividades que realizará en la Universidad, objeto de solicitud de permiso * --}}
        {{ Config::get('pregunta.actividades_realizar') }} *        
    </label>
    <div class="col-md-5">
    <input class="form-control" type="text" name="t_actividades" id="t_actividades" placeholder="Llene con resumen actividades" value="{{ old('t_actividades') }}">
    </div>
</div>
<div id="lt_presentadofiebre" class="form-group row">
    <label class="col-md-10 col-form-label">
        {{ Config::get('pregunta.fiebre') }} *
    </label>
    <div class="col-md-5">
        <input   type="radio" name="t_presentadofiebre" value="SI" {{(old('t_presentadofiebre') == 'SI') ? 'checked' : ''}} required> SI &nbsp;&nbsp;&nbsp;
        <input   type="radio" name="t_presentadofiebre" value="NO" {{(old('t_presentadofiebre') == 'NO') ? 'checked' : ''}}> NO<br>
    </div>
</div>
<div id="lt_diasfiebre" class="form-group row">
    <label class="col-md-10 col-form-label">
        {{-- 7. ¿por cuántos días la ha presentado? (formato de número en la respuesta) * --}}
        {{ Config::get('pregunta.dias_fiebre') }} *        
    </label>
    <div class="col-md-10">
        <input size="10" class="form-control col-md-1" type="number" id="t_diasfiebre" name="t_diasfiebre" placeholder="0" value="{{ old('t_diasfiebre') }}">
    </div>
</div>
<div id="lt_dolorgarganta" class="form-group row">
    <label class="col-md-10 col-form-label">
        {{-- 8. ¿Usted tiene dolor de garganta? * --}}
        {{ Config::get('pregunta.garganta') }} *        
    </label>
    <div class="col-md-5">
        <input   type="radio" name="t_dolorgarganta" value="SI" {{(old('t_dolorgarganta') == 'SI') ? 'checked' : ''}} required> SI &nbsp;&nbsp;&nbsp;
        <input   type="radio" name="t_dolorgarganta" value="NO" {{(old('t_dolorgarganta') == 'NO') ? 'checked' : ''}}> NO<br>
    </div>
</div>
<div id="lt_perdolfa" class="form-group row">
    <label class="col-md-10 col-form-label">        
        {{ Config::get('pregunta.gusto_olfato') }} *        
    </label>
    <div class="col-md-5">
        <input   type="radio" name="t_perdolfa" value="SI" {{(old('t_perdolfa') == 'SI') ? 'checked' : ''}} required> SI &nbsp;&nbsp;&nbsp;
        <input   type="radio" name="t_perdolfa" value="NO" {{(old('t_perdolfa') == 'NO') ? 'checked' : ''}}> NO<br>
    </div>
</div>
<div id="lt_malestargeneral" class="form-group row">
    <label class="col-md-10 col-form-label">
        {{-- 9. ¿Usted tiene malestar general? * --}}
        {{ Config::get('pregunta.malestar') }} *        
    </label>
    <div class="col-md-5">
        <input   type="radio" name="t_malestargeneral" value="SI" {{(old('t_malestargeneral') == 'SI') ? 'checked' : ''}}  required> SI &nbsp;&nbsp;&nbsp;
        <input   type="radio" name="t_malestargeneral" value="NO" {{(old('t_malestargeneral') == 'NO') ? 'checked' : ''}}> NO<br>
    </div>
</div>
<div id="lt_secresioncongestionnasal" class="form-group row">
    <label class="col-md-10 col-form-label">
        {{-- 10. ¿Tiene secreciones nasales o congestión nasal? (no relacionadas con procesos alérgicos) * --}}
        {{ Config::get('pregunta.secrecion') }} *
    </label>
    <div class="col-md-5">
        <input   type="radio" name="t_secresioncongestionnasal" value="SI" {{(old('t_secresioncongestionnasal') == 'SI') ? 'checked' : ''}} required> SI &nbsp;&nbsp;&nbsp;
        <input   type="radio" name="t_secresioncongestionnasal" value="NO" {{(old('t_secresioncongestionnasal') == 'NO') ? 'checked' : ''}}> NO<br>
    </div>
</div>
<div id="lt_dificultadrespirar" class="form-group row">
    <label class="col-md-10 col-form-label">
        {{-- 11. ¿Usted tiene dificultad para respirar? * --}}
        {{ Config::get('pregunta.respirar') }} *
    </label>
    <div class="col-md-5">
        <input   type="radio" name="t_dificultadrespirar" value="SI" {{(old('t_dificultadrespirar') == 'SI') ? 'checked' : ''}} required> SI &nbsp;&nbsp;&nbsp;
        <input   type="radio" name="t_dificultadrespirar" value="NO" {{(old('t_dificultadrespirar') == 'NO') ? 'checked' : ''}}> NO<br>
    </div>
</div>
<div id="lt_tosseca" class="form-group row">
    <label class="col-md-10 col-form-label">
        {{-- 12. ¿Tiene tos seca y persistente? * --}}
        {{ Config::get('pregunta.tos') }} *
    </label>
    <div class="col-md-5">
        <input   type="radio" name="t_tosseca" value="SI" {{(old('t_tosseca') == 'SI') ? 'checked' : ''}} required> SI &nbsp;&nbsp;&nbsp;
        <input   type="radio" name="t_tosseca" value="NO" {{(old('t_tosseca') == 'NO') ? 'checked' : ''}}> NO<br>
    </div>
</div>
<div id="lt_molestia_diges" class="form-group row">
    <label class="col-md-10 col-form-label">        
        {{ Config::get('pregunta.diarrea') }} *
    </label>
    <div class="col-md-5">
        <input   type="radio" name="t_molestia_diges" value="SI" {{(old('t_molestia_diges') == 'SI') ? 'checked' : ''}} required> SI &nbsp;&nbsp;&nbsp;
        <input   type="radio" name="t_molestia_diges" value="NO" {{(old('t_molestia_diges') == 'NO') ? 'checked' : ''}}> NO<br>
    </div>
</div>
<div id="lt_personalsalud" class="form-group row">
    <label class="col-md-10 col-form-label">
        {{-- 13. ¿Usted es personal activo en servicios de salud? * --}}
        {{ Config::get('pregunta.personal_salud') }} *
    </label>
    <div class="col-md-5">
        <input   type="radio" name="t_personalsalud" value="SI" {{(old('t_personalsalud') == 'SI') ? 'checked' : ''}} required> SI &nbsp;&nbsp;&nbsp;
        <input   type="radio" name="t_personalsalud" value="NO" {{(old('t_personalsalud') == 'NO') ? 'checked' : ''}}> NO<br>
    </div>
</div>
<div id="lt_contactopersonasinfectadas" class="form-group row">
    <label class="col-md-10 col-form-label">
        {{-- 14. ¿Ha estado en contacto con personas que han tenido los síntomas anteriormente mencionados o ha estado relacionado con casos de personas infectadas de Coronavirus en los últimos 7- 14 días? * --}}
        {{ Config::get('pregunta.contacto') }} *
    </label>
    <div class="col-md-5">
        <input   type="radio" name="t_contactopersonasinfectadas" value="SI" {{(old('t_contactopersonasinfectadas') == 'SI') ? 'checked' : ''}}> SI &nbsp;&nbsp;&nbsp;
        <input   type="radio" name="t_contactopersonasinfectadas" value="NO" {{(old('t_contactopersonasinfectadas') == 'NO') ? 'checked' : ''}}> NO<br>
    </div>
</div>
<div id="ld_ultimocontacto" class="form-group row">
    <label class="col-md-10 col-form-label">
        {{-- 17. ¿En qué fecha se presentó el último contacto con la persona infectada? * --}}
        {{ Config::get('pregunta.fecha_contacto') }} *
    </label>
    <div class="col-md-10">
        <input class="form-control col-md-2" type="date" id="d_ultimocontacto" name="d_ultimocontacto" value="{{ old('d_ultimocontacto') }}">
    </div>
</div>
{{-- Se comentarea por indicaciones reunion del dia 07/12/2020 nacional donde indican que no es necesario --}}
{{-- Se descomentarea por indicaciones correo del dia 13/01/2021 nacional donde indican que no es necesario --}}
<div id="lt_realizoviaje" class="form-group row">
    <label class="col-md-10 col-form-label">
        {{ Config::get('pregunta.viaje') }} *
    </label>
    <div class="col-md-5">
        <input   type="radio" name="t_realizoviaje" value="SI" {{(old('t_realizoviaje') == 'SI') ? 'checked' : ''}} required> SI &nbsp;&nbsp;&nbsp;
        <input   type="radio" name="t_realizoviaje" value="NO" {{(old('t_realizoviaje') == 'NO') ? 'checked' : ''}}> NO<br>
    </div>
</div>
<div id="ld_ultimoviaje" class="form-group row">
    <label class="col-md-10 col-form-label">        
        {{ Config::get('pregunta.fecha_viaje') }} *
    </label>
    <div class="col-md-10">
        <input class="form-control col-md-2" type="date" id="d_ultimoviaje" name="d_ultimoviaje" value="{{ old('d_ultimoviaje') }}">
    </div>
</div>
<div id="lt_sigue_aislado" class="form-group row">
    <label class="col-md-10 col-form-label">        
        {{ Config::get('pregunta.aislamiento_covid') }} *
    </label>
    <div class="col-md-5">
        <input   type="radio" name="t_sigue_aislado" value="SI" {{(old('t_sigue_aislado') == 'SI') ? 'checked' : ''}} required> SI &nbsp;&nbsp;&nbsp;
        <input   type="radio" name="t_sigue_aislado" value="NO" {{(old('t_sigue_aislado') == 'NO') ? 'checked' : ''}}> NO
        <input   type="radio" name="t_sigue_aislado" value="NA" {{(old('t_sigue_aislado') == 'NA') ? 'checked' : ''}}> NO APLICA<br>
    </div>
</div>

<div class="form-group row">
    <div class="col-md-5">
    <button type="submit" class="btn btn-info">{{ $btnText }}</button>
    </div>
</div>
