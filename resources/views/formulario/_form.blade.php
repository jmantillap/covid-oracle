@csrf

<input type="hidden" id="n_idusuario" name="n_idusuario" value="{{$n_idusuario}}">
<input type="hidden" id="t_activo" name="t_activo" value="SI">


<div class="col-md-12">
    <div class="card card-info">
        <div class="card-header">
            <h3 class="card-title">Consentimiento: <strong>{{$usuarioesta->c_codtipo}}. {{$usuarioesta->t_documento}} - {{$usuarioesta->t_nombres}} {{$usuarioesta->t_apellidos}}</strong></h3>
        </div>
        <div class="card-body">
            Que conforme a la Ley 1581 de 2012, de manera voluntaria, autorizo a la Universidad Pontificia Bolivariana a 
            tratar mis datos personales. Declaro que conozco mis derechos y deberes y las políticas de Tratamiento de 
            protección de datos de la Universidad, en mi calidad de <strong>{{$viculoconu}}</strong> conforme a la finalidad 
            de promoción, prevención y gestión de riesgo de salud, establecida por la Resolución 666 del 24 de abril de 2020 
            denominada “Por el cual se adopta el protocolo general de bioseguridad para mitigar, controlar y realizar el adecuado 
            manejo de la pandemia del Coronavirus COVID-19”, numeral 4.1 inciso 4, y conforme a los parámetros establecidos por 
            la Organización Mundial de la Salud - OMS sobre el autocuidado que cada persona debe tener para generar los medios de 
            protección que le permita salvaguardad su salud; por lo anterior, asumo el compromiso del Reporte diario de estado de 
            salud, bajo el principio de la buena fe, que lo reportado en la presente encuesta corresponde a datos verídicos asumiendo 
            la responsabilidad por cualquier dato inexacto que pueda poner en riesgo mi salud y la de los demás.
            <br><br>
            <label>
                Acepto
            </label>
            <br>
            <input   type="radio" name="t_consentimiento" value="SI"  {{(old('t_consentimiento') == 'SI') ? 'checked' : ''}}> SI &nbsp;&nbsp;&nbsp;
            <input   type="radio" name="t_consentimiento" value="NO" {{(old('t_consentimiento') == 'NO') ? 'checked' : ''}}> NO<br>
        </div>
    </div>
</div>

<br>
<div id="dn_idciudad" class="form-group row">
    <label class="col-md-10 col-form-label">
        1. Indique la ciudad a la que pertenece la sede a la cual solicita el ingreso
    </label>
    <div class="col-md-5">
        <select name="n_idciudad" class="form-control" id="n_idciudad">
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
        2. Indique para cuál sede o seccional solicita el ingreso
    </label>
    <div class="col-md-5">
        <select name="n_idsede" class="form-control" id="n_idsede">
            <option value="" >--Seleccionar Sede--</option>
        </select>
    </div>
</div>
<div id="dt_irahoy" class="form-group row">
    <label class="col-md-10 col-form-label">
        3. ¿Usted irá hoy a la Universidad o a una de sus sedes?
    </label>
    <div class="col-md-5">
        <input   type="radio" name="t_irahoy" id="SI" value="SI" {{(old('t_irahoy') == 'SI') ? 'checked' : ''}}> SI &nbsp;&nbsp;&nbsp;
        <input   type="radio" name="t_irahoy" id="NO" value="NO" {{(old('t_irahoy') == 'NO') ? 'checked' : ''}}> NO<br>
    </div>
</div>
<div id="lt_sitios" class="form-group row">
    <label class="col-md-10 col-form-label">
        4. Indique el o los sitios donde realizará sus actividades
    </label>
    <div class="col-md-5">
        <input class="form-control" type="text" id="t_sitios" name="t_sitios" placeholder="Indique el sitio" value="{{ old('t_sitios') }}">
    </div>
</div>
<div id="lt_actividades" class="form-group row">
    <label class="col-md-10 col-form-label">
        5. Actividades que realizará en la Universidad, objeto de solicitud de permiso
    </label>
    <div class="col-md-5">
    <input class="form-control" type="text" name="t_actividades" id="t_actividades" placeholder="Llene con resumen actividades" value="{{ old('t_actividades') }}">
    </div>
</div>
<div id="lt_presentadofiebre" class="form-group row">
    <label class="col-md-10 col-form-label">
        6. ¿Presenta fiebre (temperatura superior a 38º C, cuantificada con termómetro)?
    </label>
    <div class="col-md-5">
        <input   type="radio" name="t_presentadofiebre" value="SI" {{(old('t_presentadofiebre') == 'SI') ? 'checked' : ''}}> SI &nbsp;&nbsp;&nbsp;
        <input   type="radio" name="t_presentadofiebre" value="NO" {{(old('t_presentadofiebre') == 'NO') ? 'checked' : ''}}> NO<br>
    </div>
</div>
<div id="lt_diasfiebre" class="form-group row">
    <label class="col-md-10 col-form-label">
        7. En caso de haber presentado fiebre mayor a 38°C, ¿por cuántos días la ha presentado? (formato de número en la respuesta)
    </label>
    <div class="col-md-10">
        <input size="10" class="form-control col-md-1" type="number" id="t_diasfiebre" name="t_diasfiebre" placeholder="0" value="{{ old('t_diasfiebre') }}">
    </div>
</div>
<div id="lt_dolorgarganta" class="form-group row">
    <label class="col-md-10 col-form-label">
        8. ¿Usted tiene dolor de garganta?
    </label>
    <div class="col-md-5">
        <input   type="radio" name="t_dolorgarganta" value="SI" {{(old('t_dolorgarganta') == 'SI') ? 'checked' : ''}}> SI &nbsp;&nbsp;&nbsp;
        <input   type="radio" name="t_dolorgarganta" value="NO" {{(old('t_dolorgarganta') == 'NO') ? 'checked' : ''}}> NO<br>
    </div>
</div>
<div id="lt_malestargeneral" class="form-group row">
    <label class="col-md-10 col-form-label">
        9. ¿Usted tiene malestar general?
    </label>
    <div class="col-md-5">
        <input   type="radio" name="t_malestargeneral" value="SI" {{(old('t_malestargeneral') == 'SI') ? 'checked' : ''}}> SI &nbsp;&nbsp;&nbsp;
        <input   type="radio" name="t_malestargeneral" value="NO" {{(old('t_malestargeneral') == 'NO') ? 'checked' : ''}}> NO<br>
    </div>
</div>
<div id="lt_secresioncongestionnasal" class="form-group row">
    <label class="col-md-10 col-form-label">
        10. ¿Tiene secreciones nasales o congestión nasal? (no relacionadas con procesos alérgicos)
    </label>
    <div class="col-md-5">
        <input   type="radio" name="t_secresioncongestionnasal" value="SI" {{(old('t_secresioncongestionnasal') == 'SI') ? 'checked' : ''}}> SI &nbsp;&nbsp;&nbsp;
        <input   type="radio" name="t_secresioncongestionnasal" value="NO" {{(old('t_secresioncongestionnasal') == 'NO') ? 'checked' : ''}}> NO<br>
    </div>
</div>
<div id="lt_dificultadrespirar" class="form-group row">
    <label class="col-md-10 col-form-label">
        11. ¿Usted tiene dificultad para respirar?
    </label>
    <div class="col-md-5">
        <input   type="radio" name="t_dificultadrespirar" value="SI" {{(old('t_dificultadrespirar') == 'SI') ? 'checked' : ''}}> SI &nbsp;&nbsp;&nbsp;
        <input   type="radio" name="t_dificultadrespirar" value="NO" {{(old('t_dificultadrespirar') == 'NO') ? 'checked' : ''}}> NO<br>
    </div>
</div>
<div id="lt_tosseca" class="form-group row">
    <label class="col-md-10 col-form-label">
        12. ¿Tiene tos seca y persistente?
    </label>
    <div class="col-md-5">
        <input   type="radio" name="t_tosseca" value="SI" {{(old('t_tosseca') == 'SI') ? 'checked' : ''}}> SI &nbsp;&nbsp;&nbsp;
        <input   type="radio" name="t_tosseca" value="NO" {{(old('t_tosseca') == 'NO') ? 'checked' : ''}}> NO<br>
    </div>
</div>
<div id="lt_contactopersonasinfectadas" class="form-group row">
    <label class="col-md-10 col-form-label">
        13. ¿Ha estado en contacto con personas que han tenido los síntomas anteriormente mencionados o ha estado relacionado con casos de personas infectadas de Coronavirus en los últimos 7- 14 días?
    </label>
    <div class="col-md-5">
        <input   type="radio" name="t_contactopersonasinfectadas" value="SI" {{(old('t_contactopersonasinfectadas') == 'SI') ? 'checked' : ''}}> SI &nbsp;&nbsp;&nbsp;
        <input   type="radio" name="t_contactopersonasinfectadas" value="NO" {{(old('t_contactopersonasinfectadas') == 'NO') ? 'checked' : ''}}> NO<br>
    </div>
</div>
<div id="ld_ultimocontacto" class="form-group row">
    <label class="col-md-10 col-form-label">
        14. En caso de que en la anterior pregunta haya marcado "Sí", ¿en qué fecha se presentó el último contacto con la persona infectada? 
    </label>
    <div class="col-md-5">
        <input class="form-control col-md-2" type="date" id="d_ultimocontacto" name="d_ultimocontacto" value="{{ old('d_ultimocontacto') }}">
    </div>
</div>
<div id="lt_realizoviaje" class="form-group row">
    <label class="col-md-10 col-form-label">
        15. ¿Realizó un viaje nacional o internacional en los últimos 30 días?
    </label>
    <div class="col-md-5">
        <input   type="radio" name="t_realizoviaje" value="SI" {{(old('t_realizoviaje') == 'SI') ? 'checked' : ''}}> SI &nbsp;&nbsp;&nbsp;
        <input   type="radio" name="t_realizoviaje" value="NO" {{(old('t_realizoviaje') == 'NO') ? 'checked' : ''}}> NO<br>
    </div>
</div>
<div id="ld_ultimoviaje" class="form-group row">
    <label class="col-md-10 col-form-label">
        16. En caso de que en la anterior pregunta haya marcado "Sí", ¿en qué fecha realizó su ultimo viaje? 
    </label>
    <div class="col-md-5">
        <input class="form-control col-md-2" type="date" id="d_ultimoviaje" name="d_ultimoviaje" value="{{ old('d_ultimoviaje') }}"><br>
    </div>
</div>
<div class="form-group row">
    <div class="col-md-5">
    <button type="submit" class="btn btn-info">{{ $btnText }}</button>
    </div>
</div>
