@csrf

<input type="hidden" id="n_idusuario" name="n_idusuario" value="{{$n_idusuario}}">
<input type="hidden" id="t_activo" name="t_activo" value="SI">


<div class="col-md-12">
    <div class="card card-info">
        <div class="card-header">
            <h3 class="card-title">Consentimiento: <strong>{{$usuarioesta->c_codtipo}}. {{$usuarioesta->t_documento}} - {{$usuarioesta->t_nombres}} {{$usuarioesta->t_apellidos}}</strong></h3>
        </div>
        <div class="card-body">
            {{-- Que conforme a la Ley 1581 de 2012, de manera voluntaria, autorizo a la Universidad Pontificia Bolivariana a 
            tratar mis datos personales. Declaro que conozco mis derechos y deberes y las políticas de Tratamiento de 
            protección de datos de la Universidad, en mi calidad de <strong>{{$viculoconu}}</strong> conforme a la finalidad 
            de promoción, prevención y gestión de riesgo de salud, establecida por la Resolución 666 del 24 de abril de 2020 
            denominada “Por el cual se adopta el protocolo general de bioseguridad para mitigar, controlar y realizar el adecuado 
            manejo de la pandemia del Coronavirus COVID-19”, numeral 4.1 inciso 4, y conforme a los parámetros establecidos por 
            la Organización Mundial de la Salud - OMS sobre el autocuidado que cada persona debe tener para generar los medios de 
            protección que le permita salvaguardad su salud; por lo anterior, asumo el compromiso del Reporte diario de estado de 
            salud, bajo el principio de la buena fe, que lo reportado en la presente encuesta corresponde a datos verídicos asumiendo 
            la responsabilidad por cualquier dato inexacto que pueda poner en riesgo mi salud y la de los demás.
            <br><br> --}}
            {!! strip_tags(str_replace('$viculoconu',$viculoconu,Config::get('pregunta.encabezado')),'<strong>') !!}
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
        {{ Config::get('pregunta.ir_hoy') }} *
    </label>
    <div class="col-md-5">
        <input   type="radio" name="t_irahoy" id="SI" value="SI" {{(old('t_irahoy') == 'SI') ? 'checked' : ''}} required> SI &nbsp;&nbsp;&nbsp;
        <input   type="radio" name="t_irahoy" id="NO" value="NO" {{(old('t_irahoy') == 'NO') ? 'checked' : ''}}> NO<br>
    </div>
</div>
<div id="lt_sitios" class="form-group row">
    <label class="col-md-10 col-form-label">        
        {{ Config::get('pregunta.sitio_actividades') }} *       
    </label>
    <div class="col-md-5">
        <input class="form-control" type="text" id="t_sitios" name="t_sitios" placeholder="Indique el sitio" value="{{ old('t_sitios') }}">
    </div>
</div>
<div id="lt_actividades" class="form-group row">
    <label class="col-md-10 col-form-label">        
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
        {{ Config::get('pregunta.dias_fiebre') }} *        
    </label>
    <div class="col-md-10">
        <input size="10" class="form-control col-md-1" type="number" id="t_diasfiebre" name="t_diasfiebre" placeholder="0" value="{{ old('t_diasfiebre') }}">
    </div>
</div>
<div id="lt_dolorgarganta" class="form-group row">
    <label class="col-md-10 col-form-label">
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
        {{ Config::get('pregunta.malestar') }} *        
    </label>
    <div class="col-md-5">
        <input   type="radio" name="t_malestargeneral" value="SI" {{(old('t_malestargeneral') == 'SI') ? 'checked' : ''}} required> SI &nbsp;&nbsp;&nbsp;
        <input   type="radio" name="t_malestargeneral" value="NO" {{(old('t_malestargeneral') == 'NO') ? 'checked' : ''}}> NO<br>
    </div>
</div>
<div id="lt_secresioncongestionnasal" class="form-group row">
    <label class="col-md-10 col-form-label">        
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
        {{-- 15. ¿Usted es personal activo en servicios de salud? * --}}
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
        {{-- 15. ¿en qué fecha se presentó el último contacto con la persona infectada? * --}}
        {{ Config::get('pregunta.fecha_contacto') }} *
    </label>
    <div class="col-md-10">
        <input class="form-control col-md-2" type="date" id="d_ultimocontacto" name="d_ultimocontacto" value="{{ old('d_ultimocontacto') }}">
    </div>
</div>
{{-- Se comentarea por indicaciones reunion del dia 07/12/2020 nacional donde indican que no es necesario --}}
{{-- <div id="lt_realizoviaje" class="form-group row">
    <label class="col-md-10 col-form-label">        
        {{ Config::get('pregunta.viaje') }} *
    </label>
    <div class="col-md-5">
        <input   type="radio" name="t_realizoviaje" value="SI" {{(old('t_realizoviaje') == 'SI') ? 'checked' : ''}}> SI &nbsp;&nbsp;&nbsp;
        <input   type="radio" name="t_realizoviaje" value="NO" {{(old('t_realizoviaje') == 'NO') ? 'checked' : ''}}> NO<br>
    </div>
</div>
<div id="ld_ultimoviaje" class="form-group row">
    <label class="col-md-10 col-form-label">        
        {{ Config::get('pregunta.fecha_viaje') }} *
    </label>
    <div class="col-md-10">
        <input class="form-control col-md-2" type="date" id="d_ultimoviaje" name="d_ultimoviaje" value="{{ old('d_ultimoviaje') }}"><br>
    </div>
</div> --}}
<div id="lt_sigue_aislado" class="form-group row">
    <label class="col-md-10 col-form-label">        
        {{ Config::get('pregunta.aislamiento_covid') }} *
    </label>
    <div class="col-md-5">
        <input   type="radio" name="t_sigue_aislado" value="SI" {{(old('t_sigue_aislado') == 'SI') ? 'checked' : ''}} required> SI &nbsp;&nbsp;&nbsp;
        <input   type="radio" name="t_sigue_aislado" value="NO" {{(old('t_sigue_aislado') == 'NO') ? 'checked' : ''}}> NO<br>
    </div>
</div>
<div class="form-group row">
    <div class="col-md-5">
    <button type="submit" class="btn btn-info">{{ $btnText }}</button>
    </div>
</div>
