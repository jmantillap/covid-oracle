@if ($formulario==null)
    <script type = "text/javascript">
        function Redirect() {window.location = "/"; }            
        document.write("You will be redirected to main page in 10 sec.");
        setTimeout(Redirect(), 10000);
    </script>  
    @php
      return redirect()->route('home');
    @endphp
@endif
@extends('layout')
@section('title','Resultado Formulario | ' . $formulario->n_idformulario)
@section('titulopag','VERIFICACIÓN')
@section('elcontrolador','FORMULARIO')
@section('laaccion','Resultado')
@section('content')
@include('partials.session-status')
<?php

$fechafinal=\App\Utils\UtilFechas::getFechaEspanol($formulario->created_at);
$color="success";
$icono="checkmark";
$textautoriza="Si usted ya cuenta con la autorización para la presencialidad y cumple (verde) con los requisitos de encuesta de estado de salud y acta de compromiso, puede ingresar al campus.<br><br>". $fechafinal ;
if($formulario->usuario->n_idvinculou==5){
      $textautoriza="Si usted ya cuenta con la autorización para la presencialidad y cumple (verde) con los requisitos de acta de compromiso, puede ingresar al campus.<br><br>". $fechafinal ;
}    
$recomendaciones="<ul>
	<li>Para ingresar a la Universidad debes utilizar mascarilla (desechable o en tela). Si es desechables deben cambiarla diariamente, si es de tela el lavado debe ser diario.</li>
	<li> Llevar el cabello recogido</li>
	<li> Evite uso de accesorios, manillas, anillos, relojes, etc.</li>
	<li> Antes del ingreso a la Universidad, debes higienizar las manos.</li>
	<li> Si trabajas con otro compañero, deben estar trabajando a dos (2) metros de distancia.</li>
	<li> Debes estar lavándote las manos al menos cada tres horas</li>
	<li> Debes estar higienizándote las manos frecuentemente (gel antibacterial).</li>
	<li> No puedes compartir objetos y utensilios de trabajo.</li>
	<li> Si tu estancia es de todo el día debes llevar tu alimento y no lavar los recipientes en la Universidad.</li>
	<li> Procura que las areas esten ventiladas de forma natural.</li>
	<li> No promover conversaciones entre compañeros que puedan disminuir el distanciamiento físico.</li>
	<li> Debes tener las ventanas abiertas para permitir una adecuada circulación del aire.</li>
	<li> Lavarse las manos antes de comer y después de ir al baño.</li>
</ul>";
    if($formulario->n_semaforo=="2")
    {
        $color="warning";
        $icono="android-hand";
        if($formulario->usuario->n_idvinculou==1 ){
            $textautoriza="Usted no tiene permitido el ingreso a la Universidad, de forma temporal, por favor avise a su docente o director de programa y a bienestar universitario de su seccional.<br><br>". $fechafinal;
            $recomendaciones="En caso de sintomatología Covid-19 debe consultar a su EPS para que le genere incapacidad o certificado de aislamiento, recuerde enviar constancia de atención su docente o director de programa.
                  Si se equivocó en sus respuestas y no presenta síntomas relacionados con Covid-19, contacte al área de bienestar universitario de su seccional para que habilite la encuesta y la vuelva a realizar.";
        }elseif($formulario->usuario->n_idvinculou==2 || $formulario->usuario->n_idvinculou==3 || $formulario->usuario->n_idvinculou==4 || $formulario->usuario->n_idvinculou==6 ){
            $textautoriza="Usted no tiene permitido el ingreso a la Universidad, de forma temporal, por favor avise a su jefe inmediato y a seguridad y salud en el trabajo de la seccional.<br><br>". $fechafinal;
            $recomendaciones="En caso de sintomatología Covid-19 debe consultar a su EPS para que le genere incapacidad o certificado de aislamiento, recuerde enviar constancia de atención al área encargada en gestión humana. 
            Si se equivocó en sus respuestas y no presenta síntomas relacionados con Covid-19, contacte a al área de seguridad y salud en el trabajo de su seccional, para que habilite la encuesta y la vuelva a realizar.";
        }else{
            $textautoriza="Usted no tiene permitido el ingreso a la Universidad, de forma temporal, por favor avise a salud en el trabajo de la seccional.<br><br>". $fechafinal;
            $recomendaciones="En caso de sintomatología Covid-19 debe consultar a su EPS para que le genere incapacidad o certificado de aislamiento, recuerde enviar constancia de atención al área encargada en gestión humana. 
            Si se equivocó en sus respuestas y no presenta síntomas relacionados con Covid-19, contacte a al área de seguridad y salud en el trabajo de su seccional, para que habilite la encuesta y la vuelva a realizar.";
        }        
    } 
    if($formulario->n_semaforo=="3")
    {
        $color="danger";
        $icono="heart-broken";
        if($formulario->usuario->n_idvinculou==1 ){
            $textautoriza="Usted no tiene permitido el ingreso a la Universidad, de forma temporal, por favor avise a su docente o director de programa y a bienestar universitario de su seccional.<br><br>". $fechafinal;
            $recomendaciones="En caso de sintomatología Covid-19 debe consultar a su EPS para que le genere incapacidad o certificado de aislamiento, recuerde enviar constancia de atención su docente o director de programa.
                  Si se equivocó en sus respuestas y no presenta síntomas relacionados con Covid-19, contacte al área de bienestar universitario de su seccional para que habilite la encuesta y la vuelva a realizar.";
        }elseif($formulario->usuario->n_idvinculou==2 || $formulario->usuario->n_idvinculou==3 || $formulario->usuario->n_idvinculou==4 || $formulario->usuario->n_idvinculou==6 ){
            $textautoriza="Usted no tiene permitido el ingreso a la Universidad, de forma temporal, por favor avise a su jefe inmediato y a seguridad y salud en el trabajo de la seccional.<br><br>". $fechafinal;
            $recomendaciones="En caso de sintomatología Covid-19 debe consultar a su EPS para que le genere incapacidad o certificado de aislamiento, recuerde enviar constancia de atención al área encargada en gestión humana. 
              Si se equivocó en sus respuestas y no presenta síntomas relacionados con Covid-19, contacte a al área de seguridad y salud en el trabajo de su seccional, para que habilite la encuesta y la vuelva a realizar.";
        }else{
            $textautoriza="Usted no tiene permitido el ingreso a la Universidad, de forma temporal, por favor avise a salud en el trabajo de la seccional.<br><br>". $fechafinal;
            $recomendaciones="En caso de sintomatología Covid-19 debe consultar a su EPS para que le genere incapacidad o certificado de aislamiento, recuerde enviar constancia de atención al área encargada en gestión humana. 
            Si se equivocó en sus respuestas y no presenta síntomas relacionados con Covid-19, contacte a al área de seguridad y salud en el trabajo de su seccional, para que habilite la encuesta y la vuelva a realizar.";
        }
    }
?>
<div class="col-lg-12 col-12">
  <!-- small box -->
  <div class="small-box bg-{{$color}}">
    <div class="inner">
      <h3>{{$formulario->usuario->t_nombres}} <br>{{$formulario->usuario->t_apellidos}}</h3>
      <h4>{{$formulario->usuario->c_codtipo}}: {{$formulario->usuario->t_documento}} </h4>
      <p><h2><strong><?php echo $textautoriza; ?></strong></h2></p>
      <h6>{{$formulario->created_at}} </h6>      
    </div>
    <div class="icon">
      <i class="ion ion-{{$icono}}"></i>
    </div>
    <a href="#" class="small-box-footer"><i class="fas fa-calendar"></i>&nbsp;<h4>Fecha Consulta: {{date('Y-m-d h:i:s a')}} </h4></a>
  </div>
</div>

<div class="visible-print text-center">
  {!! QrCode::size(300)->generate(Request::url()); !!}
</div>

<div class="card card-{{$color}}">
  <div class="card-header">
    <h4 class="card-title">
      <a data-toggle="collapse" data-parent="#accordion" href="#collapseOne" class="" aria-expanded="true">
        <strong>Recomendaciones</strong>
      </a>
    </h4>
  </div>
  <div id="collapseOne" class="panel-collapse in collapse show" style="">
    <div class="card-body">
      <?php echo $recomendaciones ?>
    </div>
  </div>
</div>  
@endsection

@section('acta')
    @if ($acta!=null && $acta->n_idformulario_acta>=0)
        @php
        $contacte="";
        if($acta->usuario->n_idvinculou==1 ){
          $contacte="De aviso a su docente o director de programa y contacte al área de Bienestar Universitario";
        }elseif($acta->usuario->n_idvinculou==2 || $acta->usuario->n_idvinculou==3 || $acta->usuario->n_idvinculou==4 || $acta->usuario->n_idvinculou==6 ){
          $contacte="De aviso a su jefe inmediato y contacte al área de seguridad y salud en el trabajo de su seccional";          
        }else{
          $contacte="Contacte al área de seguridad y salud en el trabajo de la seccional";          
        }
        @endphp
        <div class="card card-primary">
          <div class="card-header">
            <h3 class="card-title">Resultado Acta COVID-19</h3>
            <div class="card-tools">          
            </div>
          </div>
          <div class="card-body">
            <div class="position-relative p-3 {{ $acta->n_semaforo==1 ? 'bg-success' : 'bg-danger' }} bordes" >
              <div class="ribbon-wrapper"><div class="ribbon {{ $acta->n_semaforo==1 ? 'bg-success' : 'bg-danger' }} ">{{ $acta->n_idformulario_acta }}</div></div>
              @if ($acta->n_semaforo==1)
                <h5>Si usted ya cuenta con la autorización para la presencialidad y cumple (verde) con los requisitos de encuesta de estado de salud y acta de compromiso, 
                  puede ingresar al campus. Diligenciada el {{ substr ($acta->created_at,0,10) }}</h5>
              @else
                <h5>* No tiene autorizado ingreso al campus. {{ $contacte }}, para que le habilite el acta y vuelva a realizarla. Diligenciada el {{ substr ($acta->created_at,0,10) }}</h5>    
              @endif          
            </div>
          </div>      
    @else
        <div class="card card-primary">
          <div class="card-header">
            <h3 class="card-title">Resultado Acta COVID-19</h3>
            <div class="card-tools">          
            </div>
          </div>
          <div class="card-body">
            <div class="position-relative p-3 bg-danger bordes" >
              <div class="ribbon-wrapper"><div class="ribbon bg-danger">Llenar</div></div>
              <h5>Falta LLenar Acta COVID-19</h5>
            </div>                
          </div>      
        </div>  
    @endif

@endsection
@section('comorbilidad')     
    @if ($comorbilidad!=null && $comorbilidad->n_idformulario_comorbilidad>=0)
    @php
      $contacte="";
      if($comorbilidad->usuario->n_idvinculou==1 ){
          $contacte="De aviso a su docente o director de programa y contacte al área de Bienestar Universitario";
      }elseif($comorbilidad->usuario->n_idvinculou==2 || $comorbilidad->usuario->n_idvinculou==3 || $comorbilidad->usuario->n_idvinculou==4 || $comorbilidad->usuario->n_idvinculou==6 ){
          $contacte="De aviso a su jefe inmediato y contacte al área de seguridad y salud en el trabajo de su seccional";          
      }else{
          $contacte="Contacte al área de seguridad y salud en el trabajo de la seccional";
      }
    @endphp
    <div class="card card-primary">
      <div class="card-header">
        <h3 class="card-title">Resultado Estado de Salud</h3>
        <div class="card-tools">          
        </div>
      </div>
      <div class="card-body">
        @php
            $clase='bg-success';
            if($comorbilidad->n_semaforo==2) $clase='bg-warning';
            if($comorbilidad->n_semaforo==3) $clase='bg-danger';
        @endphp        
        <div class="position-relative p-3 {{ $clase }} bordes" >                    
          <div class="ribbon-wrapper"><div class="ribbon {{ $clase }} ">{{ $comorbilidad->n_idformulario_comorbilidad }}</div></div>
          @if ($comorbilidad->n_semaforo==1)
            <h5>Si usted ya cuenta con la autorización para la presencialidad y cumple (verde) con los requisitos de encuesta de estado de salud y acta de compromiso, 
              puede ingresar al campus. Diligenciada el {{ substr ($acta->created_at,0,10) }}</h5>
          @else
            <h5>* No tiene autorizado ingreso al campus. {{ $contacte }}, para que revise su caso. Diligenciada el {{ substr ($acta->created_at,0,10) }}</h5>    
          @endif
        </div>
      </div>      
    </div>  
    @elseif($formulario->usuario->t_sigaa!='NO')    
    <div class="card card-primary">
      <div class="card-header">
        <h3 class="card-title">Resultado Estado de Salud</h3>
        <div class="card-tools">          
        </div>
      </div>
      <div class="card-body">
        <div class="position-relative p-3 bg-danger bordes" >
          <div class="ribbon-wrapper"><div class="ribbon bg-danger">Llenar</div></div>
          <h5>Falta LLenar Encuesta Estado de salud</h5>
        </div>                
      </div>      
    </div>  
    @endif
@endsection
