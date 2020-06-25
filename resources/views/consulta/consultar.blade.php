@extends('layout')
@section('title','Formulario COVID-19' )
@section('titulopag','CONSULTA DE DOCUMENTO')
@section('elcontrolador','Consulta')
@section('laaccion','Consultar Usuario')



@section('content')


<?php 

if ($errorenform=="Documento de Usuario No Registrado")
  {
  ?>
  <h4>{{$errorenform}}</h4><br>
  
  <?php
  }
?>

<?php 

if ($errorenform=="NO HA CONTESTADO EL FORMULARIO")
  {
  ?>
  <h4>{{$errorenform}} EL DÍA DE HOY ({{date('Y-m-d')}})</h4><br>
  
  <?php
  }
?>


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
  <!-- /.col -->


</div>


 
@endsection


