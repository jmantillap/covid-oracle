@extends('layout')
@section('title','Formulario COVID-19' )
@section('titulopag','PÁGINA PRINCIPAL')
@section('elcontrolador','Principal')
@section('laaccion','Selección de Tipo de Usuarios')
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

<h4>Bienvenido a la página inicial del Aplicativo de Control de Ingreso UPB</h4><br>


<div class="row">
  <div class="col-12 col-sm-6 col-md-3">
    <div class="info-box">
      <span class="info-box-icon bg-danger elevation-1"><a href="{{ route('loginupb') }}"><i class="fas fa-university"></a></i></span>

      <div class="info-box-content">
        <a href="{{ route('loginupb') }}"><span class="info-box-text">Usuarios UPB</span></a>
        
      </div>
      <!-- /.info-box-content -->
    </div>
    <!-- /.info-box -->
  </div>
  <!-- /.col -->


  <!-- fix for small devices only -->
  <div class="clearfix hidden-md-up"></div>


  <div class="col-12 col-sm-6 col-md-3">
    <div class="info-box mb-3">
      <span class="info-box-icon bg-warning elevation-1"><a href="{{ route('homeext') }}"><i class="fas fa-users"></i></a></span>

      <div class="info-box-content">
        <a href="{{ route('homeext') }}"><span class="info-box-text">Visitantes</span></a>
        
      </div>
      <!-- /.info-box-content -->
    </div>
    <!-- /.info-box -->
  </div>
  <!-- /.col -->
</div>

<div class="row"><div class="border-top my-3"></div></div>

<div class="row">
  
  <div class="col-12 col-sm-6 col-md-3">
    <div class="info-box">
      <span class="info-box-icon bg-success elevation-1"><a href="{{ route('consulta') }}"><i class="fas fa-search"></a></i></span>

      <div class="info-box-content">
        <a href="{{ route('consulta') }}"><span class="info-box-text">Resultado de Formulario vs Usuario</span></a>
        
      </div>
      <!-- /.info-box-content -->
    </div>
    <!-- /.info-box -->
  </div>
  <!-- /.col -->


</div>




{{-- @endguest --}}
@endsection
@section('script-cumstom')
<script>
    $(function () {      
      $("#menuHome" ).addClass("active" );            
      
    });
  </script>
@endsection
