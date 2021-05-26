@php
    $ciudad='';
    if(auth()->user()->ciudad!=null){      $ciudad=auth()->user()->ciudad->t_nombre;          }
@endphp
@extends('layout')
@section('title','Formulario COVID-19' )
@section('titulopag','REPORTE VACUNACIÓN DATOS')
@section('elcontrolador','Menu')
@section('laaccion','Reporte : '.$ciudad )
@section('content')
@include('partials.session-status')
@include('partials.validation-errors')
{{-- /**
 * Javier Mantilla. javier.mantillap@upb.edu.co
 * 2021-05
 */ --}}
<script src="/plugins/jquery-ui/jquery-ui.min.js"></script>
<link rel="stylesheet" href="/plugins/jquery-ui/jquery-ui.min.css">
<!-- datepicker -->
<script src="/plugins/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js"></script>
<script src="/plugins/bootstrap-datepicker/js/locales/bootstrap-datepicker.es.js"></script>
<link rel="stylesheet" href="/plugins/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css">
<link rel="stylesheet" href="/plugins/jAlert-master/dist/jAlert.css">
<script src="/plugins/jAlert-master/dist/jAlert.min.js"></script>
<script src="/plugins/jAlert-master/dist/jAlert-functions.min.js"></script>

<div class="col-md-4">
    <form method="post" id="search-form" name="search-form" data-toggle="validator" class="formulario" role="form">
      {{ csrf_field() }}
    <div id="panelDatos" class="card card-secondary">
      <div class="card-body">          
          <div class="form-group">
            <label for="tipo" >Tipo </label>
            <div class="row col-7">
              <select class="form-control" name="n_idvinculou" id="n_idvinculou" >
                  <option value="">Seleccione ...</option>
                  @foreach($listaVinculo as $vinculo)
                      <option value="{{$vinculo->n_idvinculou}}">{{$vinculo->t_vinculo}}</option>
                  @endforeach
              </select>
            </div>
        </div>  
        @if (auth()->user()->b_todas==1)
          <div class="form-group" >
            <input name="todas" id="todas"  type="checkbox" value="1" class="flat-red pull-right" > Todas las Ciudades
          </div>
        @endif  
        <div class="form-group">
          <label id="lblDocumento" for="documento">Documento del Usuario </label>
          <input size=40 class="form-control col-md-10" id="documento" name="documento" value=""><br>
        </div>                   
      </div>
      <div class="card-footer">        
          <button id="btnConsultar" type="submit" class="btn btn-info pull-right">Generar Excel</button>
      </div>
    </div> 
    </form>      
  </div>
  <div class="row">              
    
  </div>
  @endsection
  @section('script-custom')
  <script src="/plugins/chart.js/Chart.min.js"></script>
  <link rel="stylesheet" href="/plugins/chart.js/Chart.min.css">
  <script>   
      $(function () {   
        $("#menuReportes" ).addClass("menu-open" );
        $("#menuReporteVacunacioEmpleados" ).addClass("active" );   
        
        $('#btnConsultar').on('click', function(e) {                         
                $('form[name=search-form]').attr('action','{!! route('reporte.vacunacion.generar.excel'); !!}');
                $("#search-form").unbind('submit').submit();  
        });
          
          
        
      });
      
      
    </script>
  @endsection
  