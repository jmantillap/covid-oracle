@extends('layout')
@section('title','Encuesta de Estado de Salud')
@section('titulopag','ESTADO DE SALUD PARA PREVENCIÓN DE COVID-19' )
@section('elcontrolador','Formulario Usuario UPB')
@section('laaccion',' Pregunta requerida, debe responder para completar la encuesta.')
@section('content')
@include('partials.session-status')
@include('partials.validation-errors')
<style>
   input:invalid{
        border: 1px solid red;
   }
    input:valid{
        /* border: 1px solid black; */
        border: 1px solid green;
    }
</style>
<form action="{{ route('encuesta.comorbilidad.upb.guardar')}}" method="POST" id="formularioComorbilidad" name="formularioComorbilidad" class="formulario" role="form" >
    @csrf    
<div class="card card-info">
    <div class="card-header">
        <h3 class="card-title">Consentimiento: <strong>{{$usuario->c_codtipo}}. {{$usuario->t_documento}} - {{$usuario->t_nombres}} {{$usuario->t_apellidos}}</strong></h3>
    </div>
    <div class="card-body">          
        {!! strip_tags(str_replace('$viculoconu','pruebaxxx',Config::get('comorbilidad.autorizacion')),'<strong><br><ul><li><u>') !!} 
        <br><br>
        <label>
            {{ Config::get('comorbilidad.consentimiento')}}
        </label>
        <br>
        <input   type="radio" name="t_consentimiento" value="SI"  {{(old('t_consentimiento') == 'SI') ? 'checked' : ''}} required> SI &nbsp;&nbsp;&nbsp;
        <input   type="radio" name="t_consentimiento" value="NO" {{(old('t_consentimiento') == 'NO') ? 'checked' : ''}}> NO<br>
    </div>
</div>

<div id="preguntas">    
    <div>
    Estimados <strong>{{$vinculo}}</strong> de la Universidad Pontificia Bolivariana:<br><br>
    Para la Universidad tu salud y seguridad es lo primero. Desde la Rectoría General y su Equipo Directivo se ha venido siguiendo la evolución de la epidemia en tiempo real. 
    Basados en modelaciones matemáticas, las predicciones nos informan sobre cuándo se presentaría el mayor número de casos, en qué tiempos, y el impacto de las diferentes 
    estrategias emitidas por los gobiernos nacional y locales.<br><br>
    Uno de los puntos más importantes es que requerimos conocer qué <strong>{{$vinculo}}</strong> deberán continuar con telepresencia porque tienen condiciones o enfermedades 
    crónicas que, de acuerdo con la literatura médica, tendrían mayor riesgo de infección y complicaciones.<br><br>
    Por ello, los invitamos a responder esta encuesta para poder conocer cuántos de ustedes tendrían estas condiciones, y definir la modalidad de {{ $modalidad }} para cuidar 
    de su salud.<br>
    <u>Garantizamos total confidencialidad</u> y todas las respuestas serán usadas exclusivamente para las modelaciones de los escenarios. Agradecemos que por favor nos responda 
    con total sinceridad:
    </div>
    <div id="g_peso" class="form-group">
        <label for="n_peso" class="col-form-label">{{ Config::get('comorbilidad.peso') }} *</label>
        <div class="col-sm-4 input-group">   
            <input type="text" class="form-control col-sm-3 numero" id="n_peso" name="n_peso" placeholder="0"  value="{{ old('n_peso') }}" >
        </div>
    </div>   
    <div id="g_talla" class="form-group">
        <label for="n_talla" class="col-form-label">{{ Config::get('comorbilidad.talla') }} *</label>        
        <div class="col-sm-4 input-group">
            <input class="form-control col-md-3 numero"  id="n_talla" name="n_talla" placeholder="0" value="{{ old('n_talla') }}" >
        </div>
    </div>

    <div id="g_fuma" class="form-group">
        <label for="t_fuma" class="col-form-label">{{ Config::get('comorbilidad.fuma') }} *</label>
        <div class="col-sm-4">
            <input   type="radio" id="t_fuma" name="t_fuma" value="SI" {{(old('t_fuma') == 'SI') ? 'checked' : ''}} > SI &nbsp;&nbsp;&nbsp;
            <input   type="radio" id="t_fuma" name="t_fuma" value="NO" {{(old('t_fuma') == 'NO') ? 'checked' : ''}}> NO
        </div>
    </div>
    <div id="g_cigarrillos" class="form-group">
        <label for="n_cigarrillos_dia" class="col-form-label">{{ Config::get('comorbilidad.cigarrillos') }} *</label>
        <div class="col-sm-4">
            <input size="10" class="form-control col-md-3 numero" id="n_cigarrillos_dia" name="n_cigarrillos_dia" placeholder="0" value="{{ old('n_cigarrillos_dia') }}">
        </div>
    </div>
    <div id="g_hipertension" class="form-group">
        <label for="t_hipertension" class="col-form-label">{{ Config::get('comorbilidad.hipertension') }} *</label>
        <div class="col-sm-5 ">
            <input type="radio" id="t_hipertension" name="t_hipertension" value="SI" {{(old('t_hipertension') == 'SI') ? 'checked' : ''}} > SI &nbsp;&nbsp;&nbsp;
            <input type="radio" id="t_hipertension" name="t_hipertension" value="NO" {{(old('t_hipertension') == 'NO') ? 'checked' : ''}}> NO
        </div>
    </div>
    <div id="g_medicamentos_hipertension" class="form-group">
        <label for="t_medicamento_hipertension" class="col-form-label">{{ Config::get('comorbilidad.medicamentos_hipertension') }} *</label>
        <div class="col-sm-10">
            <input maxlength="255" class="form-control"  name="t_medicamento_hipertension" id="t_medicamento_hipertension" placeholder="Medicamentos hipertensión" 
            value="{{ old('t_medicamento_hipertension') }}">
        </div>
    </div>
    <div id="g_diabetes" class="form-group">
        <label for="t_diabetes" class="col-form-label">{{ Config::get('comorbilidad.diabetes') }} *</label>
        <div class="col-sm-5">
            <input   type="radio" id="t_diabetes" name="t_diabetes" value="SI" {{(old('t_diabetes') == 'SI') ? 'checked' : ''}} > SI &nbsp;&nbsp;&nbsp;
            <input   type="radio" id="t_diabetes" name="t_diabetes" value="NO" {{(old('t_diabetes') == 'NO') ? 'checked' : ''}}> NO
        </div>
    </div>
    <div id="g_medicamentos_diabetes" class="form-group">
        <label for="t_medicamento_diabetes" class="col-form-label">{{ Config::get('comorbilidad.medicamentos_diabetes') }} *</label>
        <div class="col-sm-10">
            <input maxlength="255" class="form-control"  name="t_medicamento_diabetes" id="t_medicamento_diabetes" placeholder="Medicamentos Diabetes" 
            value="{{ old('t_medicamento_diabetes') }}">
        </div>
    </div>
    <div id="g_corazon" class="form-group">
        <label for="t_corazon" class="col-form-label">{{ Config::get('comorbilidad.corazon') }} *</label>
        <div class="col-sm-5">
            <input type="radio" id="t_corazon" name="t_corazon" value="SI" {{(old('t_corazon') == 'SI') ? 'checked' : ''}} > SI &nbsp;&nbsp;&nbsp;
            <input type="radio" id="t_corazon" name="t_corazon" value="NO" {{(old('t_corazon') == 'NO') ? 'checked' : ''}}> NO
        </div>
    </div>
    <div id="g_enfermedad_corazon" class="form-group">
        <label for="t_enfermedad_corazon" class="col-form-label">{{ Config::get('comorbilidad.corazon_enfermedad') }} *</label>
        <div class="col-sm-10">
            <input maxlength="255" class="form-control"  name="t_enfermedad_corazon" id="t_enfermedad_corazon" placeholder="Enfermedad de Corazón" 
            value="{{ old('t_enfermedad_corazon') }}">
        </div>
    </div>
    <div id="g_pulmonar" class="form-group">
        <label for="t_pulmonar" class="col-form-label">{{ Config::get('comorbilidad.pulmonar') }} *</label>
        <div class="col-sm-5">
            <input type="radio" id="t_pulmonar" name="t_pulmonar" value="SI" {{(old('t_pulmonar') == 'SI') ? 'checked' : ''}} > SI &nbsp;&nbsp;&nbsp;
            <input type="radio" id="t_pulmonar" name="t_pulmonar" value="NO" {{(old('t_pulmonar') == 'NO') ? 'checked' : ''}}> NO
        </div>
    </div>
    <div id="g_enfermedad_pulmonar" class="form-group">
        <label for="t_enfermedad_pulmonar" class="col-form-label">{{ Config::get('comorbilidad.pulmonar_enfermedad') }} *</label>
        <div class="col-sm-10">
            <input maxlength="255" class="form-control"  name="t_enfermedad_pulmonar" id="t_enfermedad_pulmonar" placeholder="Enfermedad Pulmonar" 
            value="{{ old('t_enfermedad_pulmonar') }}">
        </div>
    </div>
    <div id="g_medicamento_defensas_bajas" class="form-group">
        <label for="t_medicamento_defensas_bajas" class="col-form-label">{{ Config::get('comorbilidad.defensas_bajas') }} *</label>
        <div class="col-sm-5">
            <input type="radio" id="t_medicamento_defensas_bajas" name="t_medicamento_defensas_bajas" value="SI" {{(old('t_medicamento_defensas_bajas') == 'SI') ? 'checked' : ''}} > SI &nbsp;&nbsp;&nbsp;
            <input type="radio" id="t_medicamento_defensas_bajas" name="t_medicamento_defensas_bajas" value="NO" {{(old('t_medicamento_defensas_bajas') == 'NO') ? 'checked' : ''}}> NO
        </div>
    </div>
    <div id="g_cuales_med_defensas_bajas" class="form-group">
        <label for="t_cuales_med_defensas_bajas" class="col-form-label">{{ Config::get('comorbilidad.defensas_bajas_medicamentos') }} *</label>
        <div class="col-sm-10">
            <input maxlength="255" class="form-control"  name="t_cuales_med_defensas_bajas" id="t_cuales_med_defensas_bajas" placeholder="Medicamento enfermedades Autoinmune" 
            value="{{ old('t_cuales_med_defensas_bajas') }}">
        </div>
    </div>
    <div id="g_inmunodeficiencia" class="form-group">
        <label for="t_inmunodeficiencia" class="col-form-label">{{ Config::get('comorbilidad.inmunodeficiencia') }} *</label>
        <div class="col-sm-5">
            <input type="radio" id="t_inmunodeficiencia" name="t_inmunodeficiencia" value="SI" {{(old('t_inmunodeficiencia') == 'SI') ? 'checked' : ''}} > SI &nbsp;&nbsp;&nbsp;
            <input type="radio" id="t_inmunodeficiencia" name="t_inmunodeficiencia" value="NO" {{(old('t_inmunodeficiencia') == 'NO') ? 'checked' : ''}}> NO
        </div>
    </div>
    <div id="g_cancer" class="form-group">
        <label for="t_cancer" class="col-form-label">{{ Config::get('comorbilidad.cancer') }} *</label>
        <div class="col-sm-5">
            <input   type="radio" id="t_cancer" name="t_cancer" value="SI" {{(old('t_cancer') == 'SI') ? 'checked' : ''}} > SI &nbsp;&nbsp;&nbsp;
            <input   type="radio" id="t_cancer" name="t_cancer" value="NO" {{(old('t_cancer') == 'NO') ? 'checked' : ''}}> NO
        </div>
    </div>
    <div id="g_quimioterapia_cancer" class="form-group">
        <label for="t_quimioterapia_cancer" class="col-form-label">{{ Config::get('comorbilidad.quimioterapia') }} *</label>
        <div class="col-sm-5">
            <input   type="radio" id="t_quimioterapia_cancer" name="t_quimioterapia_cancer" value="SI" {{(old('t_quimioterapia_cancer') == 'SI') ? 'checked' : ''}} > SI &nbsp;&nbsp;&nbsp;
            <input   type="radio" id="t_quimioterapia_cancer" name="t_quimioterapia_cancer" value="NO" {{(old('t_quimioterapia_cancer') == 'NO') ? 'checked' : ''}}> NO
        </div>
    </div>
    <div id="g_convive" class="form-group">
        <label class="col-form-label">{{ Config::get('comorbilidad.convive') }} *</label>
        <div class="col-sm-12">
           <input type="checkbox" id="t_convive_mayor" name="t_convive_mayor" value="SI" {{(old('t_convive_mayor') == 'SI') ? 'checked' : ''}} > {{ Config::get('comorbilidad.convive_mayor_60') }}<br/>
           <input type="checkbox" id="t_convive_bajas_defensas"
           name="t_convive_bajas_defensas" value="SI" {{(old('t_convive_bajas_defensas') == 'NO') ? 'checked' : ''}}>{{ Config::get('comorbilidad.convive_bajas_defensas') }}<br>
           <input type="checkbox" id="t_convive_pulmonar"
           name="t_convive_pulmonar" value="SI" {{(old('t_convive_pulmonar') == 'SI') ? 'checked' : ''}} > {{ Config::get('comorbilidad.convive_enfermedad_pulmonar') }}<br/>
           <input type="checkbox" id="t_convive_cancer" name="t_convive_cancer" value="SI" {{(old('t_convive_cancer') == 'SI') ? 'checked' : ''}} > {{ Config::get('comorbilidad.convive_cancer') }}<br/>
           <input type="checkbox" id="t_convive_otras" name="t_convive_otras" value="SI" {{(old('t_convive_otras') == 'SI') ? 'checked' : ''}} > {{ Config::get('comorbilidad.convive_otra') }}
           <input maxlength="50" class="form-control col-md-3" id="t_convive_cual" name="t_convive_cual" id="t_convive_cual" placeholder="Cuál" 
            value="{{ old('t_convive_cual') }}" >
           
        </div>
    </div>
    <label>Gracias por responder esta encuesta. Tu salud es nuestra prioridad</label>
</div>
<div class="form-group row">
    <div class="col-md-5">
    <button type="submit" class="btn btn-info" id="btnGuardarFormulario" >Guardar</button>
    </div>
</div>
</form>

@endsection
@section('script-custom')
<link rel="stylesheet" href="/plugins/jAlert-master/dist/jAlert.css">
<script src="/plugins/jAlert-master/dist/jAlert.min.js"></script>
<script src="/plugins/jAlert-master/dist/jAlert-functions.min.js"></script>
<script>         
    $(function () {
        $("#menuEncuestaComorbilidad").addClass("active" );
       
        
        $('input[type=radio][name=t_consentimiento]').change(function() { if (this.value == 'SI') { $("#preguntas").show(); camposObligatorios(this.value);
            }else{$("#preguntas").hide(); camposObligatorios('NO');}});

        $('input[type=radio][name=t_fuma]').change(function() { if (this.value == 'SI') { $("#n_cigarrillos_dia").prop('required', true).show(); $("#g_cigarrillos").show();                    
            }else{ $("#n_cigarrillos_dia").prop('required', false).hide().val(''); $("#g_cigarrillos").hide(); }});

        $('input[type=radio][name=t_hipertension]').change(function() { if (this.value == 'SI') { $("#t_medicamento_hipertension").prop('required', true).show(); 
        $("#g_medicamentos_hipertension").show(); }else{ $("#t_medicamento_hipertension").prop('required', false).hide().val(''); $("#g_medicamentos_hipertension").hide(); }});

        $('input[type=radio][name=t_diabetes]').change(function() { if (this.value == 'SI') { $("#t_medicamento_diabetes").prop('required', true).show(); 
        $("#g_medicamentos_diabetes").show(); }else{ $("#t_medicamento_diabetes").prop('required', false).hide().val(''); $("#g_medicamentos_diabetes").hide(); }});

        $('input[type=radio][name=t_corazon]').change(function() { if (this.value == 'SI') { $("#t_enfermedad_corazon").prop('required', true).show(); 
        $("#g_enfermedad_corazon").show(); }else{ $("#t_enfermedad_corazon").prop('required', false).hide().val(''); $("#g_enfermedad_corazon").hide(); }});

        $('input[type=radio][name=t_pulmonar]').change(function() { if (this.value == 'SI') { $("#t_enfermedad_pulmonar").prop('required', true).show(); 
        $("#g_enfermedad_pulmonar").show(); }else{ $("#t_enfermedad_pulmonar").prop('required', false).hide().val(''); $("#g_enfermedad_pulmonar").hide(); }});

        $('input[type=radio][name=t_medicamento_defensas_bajas]').change(function() { if (this.value == 'SI') { $("#t_cuales_med_defensas_bajas").prop('required', true).show(); 
        $("#g_cuales_med_defensas_bajas").show(); }else{ $("#t_cuales_med_defensas_bajas").prop('required', false).hide().val(''); $("#g_cuales_med_defensas_bajas").hide(); }});

        $('input[type=radio][name=t_cancer]').change(function() { 
            if (this.value == 'SI') { 
                $("#t_quimioterapia_cancer").prop('required', true).show(); $("#g_quimioterapia_cancer").show(); 
            }else{ 
                $("#t_quimioterapia_cancer").prop('required', false).hide().val(''); $("input[name='t_quimioterapia_cancer']").prop('checked', false);                
                $("#g_quimioterapia_cancer").hide(); 
            }
        });
        $('input[type=checkbox][name=t_convive_otras]').change(function(e) { 
            if(this.checked){$("#t_convive_cual").prop('required', true).show();}else{$("#t_convive_cual").prop('required', false).hide().val('');}            
        });

    });
    @if(is_null(old('t_consentimiento'))   )
            initForm();    
    @else
        $("#preguntas").show();
        @if(old('t_fuma')=='NO') $("#g_cigarrillos").hide(); @endif
        @if(old('t_hipertension')=='NO') $("#g_medicamentos_hipertension").hide(); @endif
        @if(old('t_diabetes')=='NO') $("#g_medicamentos_diabetes").hide(); @endif
        @if(old('t_corazon')=='NO') $("#g_enfermedad_corazon").hide(); @endif
        @if(old('t_pulmonar')=='NO') $("#g_enfermedad_pulmonar").hide(); @endif
        @if(old('t_medicamento_defensas_bajas')=='NO') $("#g_cuales_med_defensas_bajas").hide(); @endif
        @if(old('t_cancer')=='NO') $("#g_quimioterapia_cancer").hide(); @endif

    @endif
    function camposObligatorios(valor){
        $("#n_peso").prop('required',(valor=='SI') ? true : false);        
        $("#n_talla").prop('required',(valor=='SI') ? true : false);        
        $('#t_fuma').prop('required',(valor=='SI') ? 'required' : false);                
        $('#t_hipertension').prop('required',(valor=='SI') ? true : false);
        $('#t_diabetes').prop('required',(valor=='SI') ? true : false);
        $("#t_corazon").prop('required',(valor=='SI') ? true : false);
        $("#t_pulmonar").prop('required',(valor=='SI') ? true : false);
        $("#t_medicamento_defensas_bajas").prop('required',(valor=='SI') ? true : false);        
        $("#t_inmunodeficiencia").prop('required',(valor=='SI') ? true : false);
        $("#t_cancer").prop('required',(valor=='SI') ? true : false);        
    }
    function initForm(){
        $("#preguntas").hide();
        $("#g_cigarrillos").hide();
        $("#g_medicamentos_hipertension").hide();
        $("#g_medicamentos_diabetes").hide();
        $("#g_enfermedad_corazon").hide();
        $("#g_enfermedad_pulmonar").hide();
        $("#g_cuales_med_defensas_bajas").hide();
        $("#g_quimioterapia_cancer").hide();
        
    }
</script>
@endsection

{{-- // $(document).on('click','#btnGuardarFormulario',function(event){                                
    //     //$("#formularioComorbilidad").unbind('submit').submit(); //$("#formularioComorbilidad").submit();                
    //     var $form = $('#formularioComorbilidad')[0];
    //     // Check if valid using HTML5 checkValidity() builtin function
    //     if ($form.checkValidity()) {
    //         //console.log('valid');
    //         $form.submit();
    //     } else {
    //         console.log('not valid');
    //         errorAlert('Error','Falta Seleccionar campos obligatorios.');
    //     }
    // }); --}}