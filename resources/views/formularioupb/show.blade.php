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

$elmes="";
  $eldia="";
  $fechaformulario=strtotime($formulario->created_at);
  $mes=date("n", $fechaformulario);
  $diasemana=date("w", $fechaformulario);
  $dia=date("j", $fechaformulario);
  $year=date("Y", $fechaformulario);

  switch ($mes) {
    case "1":
        $elmes="Enero";
        break;
    case "2":
        $elmes="Febrero";
        break;
    case "3":
        $elmes="Marzo";
        break;
    case "4":
        $elmes="Abril";
        break;
    case "5":
        $elmes="Mayo";
        break;
    case "6":
        $elmes="Junio";
        break;
    case "7":
        $elmes="Julio";
        break;
    case "8":
        $elmes="Agosto";
        break;
    case "9":
        $elmes="Septiembre";
        break;
    case "10":
        $elmes="Octubre";
        break;
    case "11":
        $elmes="Noviembre";
        break;
    case "12":
        $elmes="Diciembre";
        break;
        
}

switch ($diasemana) {
    case "0":
        $eldia="Domingo";
        break;
    case "1":
        $eldia="Lunes";
        break;
    case "2":
        $eldia="Martes";
        break;
    case "3":
        $eldia="Miércoles";
        break;
    case "4":
        $eldia="Jueves";
        break;
    case "5":
        $eldia="Viernes";
        break;
        case "6":
    $eldia="Sábado";
        break;
    
        
} 
 
$fechafinal= $eldia.", ".$dia." de ".$elmes." de ".$year;

$color="success";
$icono="checkmark";
$textautoriza="Si usted solicitó el ingreso y cumplió los requerimientos, está autorizado, de lo contrario continúe en casa.<br><br>". $fechafinal ;
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
    $textautoriza="Usted no tiene permitido el ingreso a la Universidad, de forma temporal, por favor avise a su jefe inmediato o al contacto en la Universidad hacia donde se dirigía<br><br>". $fechafinal;
    $recomendaciones="Si presenta sintomatología, no debe consultar al servicio de urgencias, sino que debe quedarse en casa, tener aislamiento, usar tapabocas, hacer lavado frecuente de manos y marcar los números telefónicos establecidos para esto, ciñéndonos a las directrices del Gobierno Nacional y la Organización Mundial de la Salud.";
  } 
if($formulario->n_semaforo=="3")
  {
    $color="danger";
    $icono="heart-broken";
    $textautoriza="Usted no tiene permitido el ingreso a la Universidad, de forma temporal, por favor avise a su jefe inmediato o al contacto de la Universidad hacia donde se dirigía<br><br>". $fechafinal;
    $recomendaciones="Si presenta sintomatología, no debe consultar al servicio de urgencias, sino que debe quedarse en casa, tener aislamiento, usar tapabocas, hacer lavado frecuente de manos y marcar los números telefónicos establecidos para esto, ciñéndonos a las directrices del Gobierno Nacional y la Organización Mundial de la Salud.";
  }


?>



<div class="col-lg-12 col-12">
  <!-- small box -->
  <div class="small-box bg-{{$color}}">
    <div class="inner">
      <h3>{{$formulario->usuario->t_nombres}} <br>{{$formulario->usuario->t_apellidos}}</h3>
      <h4>{{$formulario->usuario->c_codtipo}}: {{$formulario->usuario->t_documento}} </h4>
<br>
      <p><h1><strong><?php echo $textautoriza; ?></strong></h1></p>

      <br>
    </div>
    <div class="icon">
      <i class="ion ion-{{$icono}}"></i>
    </div>
    <a href="#" class="small-box-footer"><i class="fas fa-calendar"></i>&nbsp;<h4>{{date('Y-m-d h:i:s a')}} </h4></a>
  </div>
</div>

<div class="visible-print text-center">
  {!! QrCode::size(300)->generate(Request::url()); !!}
{{-- <p>{{ Request::url() }}</p> --}}
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


