@extends('layout')
@section('title','Formulario COVID-19' )
@section('titulopag','PÁGINA PRINCIPAL')
@section('elcontrolador','Principal')
@section('laaccion','Selección de Tipo de Usuarios')
<style>
      #tooltip-usuarios-upb, #tooltip-visitantes {
            background: #333;
            color: white;
            font-weight: bold;
            padding: 4px 8px;
            font-size: 18px;
            border-radius: 4px;
            display: none;
      }
      #tooltip-usuarios-upb[data-show], #tooltip-visitantes[data-show] {
           display: block;
      }
      #arrow, #arrow::before {
        position: absolute;
        width: 8px;
        height: 8px;
        z-index: -1;
      }
      #arrow::before {
        content: '';
        transform: rotate(45deg);
        background: #333;
      }
      #tooltip-usuarios-upb[data-popper-placement^='top'] > #arrow, #tooltip-visitantes[data-popper-placement^='top'] > #arrow {
        bottom: -4px;
      }
      #tooltip-usuarios-upb[data-popper-placement^='bottom'] > #arrow, #tooltip-visitantes[data-popper-placement^='bottom'] > #arrow {
        top: -4px;
      }
      #tooltip-usuarios-upb[data-popper-placement^='left'] > #arrow,#tooltip-visitantes[data-popper-placement^='left'] > #arrow  {
        right: -4px;
      }
      #tooltip-usuarios-upb[data-popper-placement^='right'] > #arrow, #tooltip-visitantes[data-popper-placement^='right'] > #arrow {
        left: -4px;
      }
</style>
<?php
if (Auth::check())
    
    $nombrecompleto= Auth::user()->t_nombres.' '.Auth::user()->t_apellidos;
else {
    $nombrecompleto="Invitado";
    }
?>

@section('nombusuario', $nombrecompleto )

@section('content')
@include('partials.session-status')
@include('partials.validation-errors')

<h4>¡Bienvenido! Este es el registro para el control de ingreso a la UPB.</h4><br>
<h5 align="justify">Para la continuidad de nuestro retorno responsable e inteligente a la UPB es fundamental que cada uno realice de forma consciente y responsable la siguiente encuesta, reportando su estado de salud y síntomas diariamente, ya sea porque vayas a ir a la Universidad o estés desde tu casa. ¡De esto depende nuestra salud y bienestar!<h5><br><br>


<div class="row">
  <div class="col-12 col-sm-7 col-md-3">
    <div class="info-box">
      <span class="info-box-icon bg-danger elevation-1">
        <a id="usuario-upb" href="{{ route('loginupb') }}" aria-describedby="tooltip-usuarios-upb"  >
          <i class="fas fa-university"></a></i></span>

      <div class="info-box-content">
        <a id="usuario-upb-enlace" href="{{ route('loginupb') }}" aria-describedby="tooltip-usuarios-upb" >
          <span class="info-box-text"  >Usuarios UPB</span></a>        
      </div>
      <!-- /.info-box-content -->
    </div>
    <!-- /.info-box -->
  </div>
  <!-- /.col -->


  <!-- fix for small devices only -->
  <div class="clearfix hidden-md-up"></div>


  <div class="col-12 col-sm-7 col-md-3">
    <div class="info-box mb-2">
      <span class="info-box-icon bg-warning elevation-1"><a id="icono-visitante" aria-describedby="tooltip-visitantes"  href="{{ route('homeext') }}"><i class="fas fa-users"></i></a></span>

      <div class="info-box-content">
        <a id="visitante-enlace" aria-describedby="tooltip-visitantes" href="{{ route('homeext') }}"><span class="info-box-text">Visitantes</span></a>
        
      </div>
      <!-- /.info-box-content -->
    </div>
    <!-- /.info-box -->
  </div>
  <!-- /.col -->

<div class="col-12 col-sm-7 col-md-4">
    <div class="info-box mb-2">
      <span class="info-box-icon bg-success elevation-1"><a href="{{ route('consulta') }}"><i class="fas fa-search"></a></i></span>

      <div class="info-box-content">
        <a href="{{ route('consulta') }}"><span class="info-box-text">Resultado de Formulario</span></a>
        
      </div>
      <!-- /.info-box-content -->
    </div>
    <!-- /.info-box -->
  </div>
  <!-- /.col -->
</div>

<div class="row"><div class="border-top my-3"></div></div>

{{-- @endguest --}}
<script src="/plugins/bootstrap/js/popper.min.js"></script>


<div id="tooltip-usuarios-upb" role="tooltip">Estudiantes, Docentes, Empleados, Egresados, CUB</div>
<div id="tooltip-visitantes" role="tooltip">Contratistas, Proveedores, Visitantes</div>
<script>
  const iconoUsuarioUpb = document.querySelector('#usuario-upb');
  const enlaceUsuarioUpb = document.querySelector('#usuario-upb-enlace');

  const iconoVisitante = document.querySelector('#icono-visitante');
  const enlaceVisitante = document.querySelector('#visitante-enlace');

  const tooltipUsuarioUpb = document.querySelector('#tooltip-usuarios-upb');  
  const tooltipVisitante = document.querySelector('#tooltip-visitantes');  

  let popperInstanceUsuarios1 = null;
  let popperInstanceUsuarios2 = null;
  let popperInstanceV1 = null;
  let popperInstanceV2 = null;

  function createUsuarioUpb() {
        popperInstanceUsuarios1 = Popper.createPopper(iconoUsuarioUpb, tooltipUsuarioUpb, {
              placement: 'right',
              modifiers: [ {name: 'offset',options: {offset: [0, 8],},},],
        });
        popperInstanceUsuarios2 = Popper.createPopper(enlaceUsuarioUpb, tooltipUsuarioUpb, {
          placement: 'top',
          modifiers: [{name: 'offset',options: {offset: [0, 8],},},],
        });
  }
  function createVisitante() {        
        popperInstanceV1 = Popper.createPopper(iconoVisitante, tooltipVisitante, {
              placement: 'right',
              modifiers: [ {name: 'offset',options: {offset: [0, 8],},},],
        });
        popperInstanceV2 = Popper.createPopper(enlaceVisitante, tooltipVisitante, {
          placement: 'top',
          modifiers: [{name: 'offset',options: {offset: [0, 8],},},],
        });
  }


  function destroyUpb() {
      if (popperInstanceUsuarios1) {
          popperInstanceUsuarios1.destroy();
          popperInstanceUsuarios1 = null;
      }
      if (popperInstanceUsuarios2) {
          popperInstanceUsuarios2.destroy();
          popperInstanceUsuarios2 = null;
      }      
  }
  function destroyVisitante() {
      if (popperInstanceV1) {
          popperInstanceV1.destroy();
          popperInstanceV1 = null;
      }
      if (popperInstanceV2) {
          popperInstanceV2.destroy();
          popperInstanceV2 = null;
      }
  }

  function showUpb() {
    tooltipUsuarioUpb.setAttribute('data-show', '');    
    createUsuarioUpb();
  }
  function showVisitante() {    
    tooltipVisitante.setAttribute('data-show', '');
    createVisitante();
  }

  function hideUpb() {
    tooltipUsuarioUpb.removeAttribute('data-show');    
    destroyUpb();
  }

  function hideVisitante() {    
    tooltipVisitante.removeAttribute('data-show');
    destroyVisitante();
  }


  const showEvents = ['mouseenter', 'focus'];
  const hideEvents = ['mouseleave', 'blur'];

  showEvents.forEach(event => {
    iconoUsuarioUpb.addEventListener(event, showUpb);
    enlaceUsuarioUpb.addEventListener(event, showUpb);
    iconoVisitante.addEventListener(event, showVisitante);
    enlaceVisitante.addEventListener(event, showVisitante);
  });

  hideEvents.forEach(event => {
    iconoUsuarioUpb.addEventListener(event, hideUpb);
    enlaceUsuarioUpb.addEventListener(event, hideUpb);
    iconoVisitante.addEventListener(event, hideVisitante);
    enlaceVisitante.addEventListener(event, hideVisitante);
    
  });
</script>
@endsection
@section('script-cumstom')
<script>
    $(function () {      
      $("#menuHome" ).addClass("active" );                  
    });    
  </script>

@endsection
