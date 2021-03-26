@extends('layout')
@section('title','Formulario COVID-19' )
@section('titulopag','CONSULTA DE DOCUMENTO')
@section('elcontrolador','Consulta')
@section('laaccion','Consultar Usuario')
@section('content')

@if ($errorenform=="Documento de Usuario No Registrado")
  <div class="position-relative p-3 bg-danger bordes" ><div class="ribbon-wrapper">
    <div class="ribbon bg-danger">No valido</div></div>
    <h4>* {{$errorenform}}</h4>
  </div>
  <br>
@endif
@if ($errorenform=="NO HA CONTESTADO EL FORMULARIO")    
    <div class="position-relative p-3 bg-danger bordes" ><div class="ribbon-wrapper">
      <div class="ribbon bg-danger">Llenar</div></div>
      <h4>* {{$errorenform}} EL DÍA DE HOY ({{date('Y-m-d')}})</h4>
    </div>
    <br>
@endif
@if($idusuario!="" && $usuarioesta!=null) {{-- && $usuarioesta->t_sigaa=='SI' --}}
    @php
        $contacte="";
        if($usuarioesta->n_idvinculou==1 ){
          $contacte="De aviso a su docente o director de programa y contacte al área de Bienestar Universitario";
        }elseif($usuarioesta->n_idvinculou==2 || $usuarioesta->n_idvinculou==3 || $usuarioesta->n_idvinculou==4 || $usuarioesta->n_idvinculou==6 ){
          $contacte="De aviso a su jefe inmediato y contacte al área de seguridad y salud en el trabajo de su seccional";          
        }else{
          $contacte=" Contacte al área de seguridad y salud en el trabajo de su seccional";
        }
    @endphp
    @if (($acta=App\Services\FormularioServices::getActaCovidUsuario($usuarioesta->n_idusuario))==null)
        <div class="position-relative p-3 bg-danger bordes" ><div class="ribbon-wrapper">
          <div class="ribbon bg-danger">Llenar</div></div>
          <h4>* FALTA LLENAR EL ACTA DE COMPROMISO </h4>
        </div>
        <br>
    @elseif ($acta!=null && $acta->n_semaforo!=1)           
        <div class="position-relative p-3 bg-danger bordes" ><div class="ribbon-wrapper">
          <div class="ribbon bg-danger">Acta</div></div>
          <h4>* No tiene autorizado ingreso al campus. {{ $contacte }}, para que le habilite el acta de compromiso y la vuelva a realizarla. </h4>
        </div>
        <br>
    @endif
    @if (($comorbilidad=App\Services\FormularioServices::getEncuestaComorbilidadUsuario($usuarioesta->n_idusuario))==null && $usuarioesta->t_sigaa=='SI' )
        <div class="position-relative p-3 bg-danger bordes" >
          <div class="ribbon-wrapper"><div class="ribbon bg-danger">Llenar</div></div>
          <h4>* FALTA LLENAR EL ESTADO DE SALUD </h4>
        </div>
        <br>
    @elseif ($comorbilidad!=null && $comorbilidad->n_semaforo!=1)        
    <div class="position-relative p-3 bg-danger bordes" ><div class="ribbon-wrapper">
      <div class="ribbon bg-danger">Salud</div></div>
      <h4>* No tiene autorizado ingreso al campus. {{ $contacte }}, para que revise su caso. </h4>
    </div>
    <br>
    @endif

@endif
<div class="row">  
  <div class="col-12 col-sm-2 col-md-4">
    <div class="info-box">
      <span class="info-box-icon bg-success elevation-1"><a href="{{ route('consulta') }}"><i class="fas fa-arrow-left"></a></i></span>

      <div class="info-box-content">
          <a href="{{ route('consulta') }}"><span class="info-box-text">Ir a página Anterior</span></a>        
      </div>      
      <!-- /.info-box-content -->
    </div>
    <!-- /.info-box -->
  </div>

</div>
<div class="row">
  <div class="col-12 col-sm-2 col-md-4">
    <div class="info-box">
      <span class="info-box-icon bg-success elevation-1"><a href="{{ route('home') }}"><i class="fas fa-arrow-left"></a></i></span>
      <div class="info-box-content">
          <a href="{{ route('home') }}"><span class="info-box-text">Ir al Inicio</span></a>        
      </div>
      <!-- /.info-box-content -->
    </div>
    <!-- /.info-box -->
  </div>
  <!-- /.col -->
</div>

 
@endsection


