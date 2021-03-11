@php
    $ciudad='';
    if(auth()->user()->ciudad!=null){
      $ciudad=auth()->user()->ciudad->t_nombre;
      if(auth()->user()->b_estudiantes==1){ $ciudad.=" (SOLO ESTUDIANTES)"; }      
    }
@endphp

@extends('layout')
@section('title','Formulario COVID-19' )
@section('titulopag','ESTADO DE SALUD')
@section('elcontrolador','Menu')
@section('laaccion','Reporte : '.$ciudad )
@section('content')
@include('partials.session-status')
@include('partials.validation-errors')
{{-- /**
 * Javier Mantilla. javier.mantillap@upb.edu.co
 * 2021-01
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
  <div id="panelFechas" class="card card-secondary">
    <div class="card-body">
        <div class="form-group fecha-desde" >
            <label for="fecha_desde" >Fecha Desde *</label>
            <div class="input-group date " style="width:200px" >
                <div class="input-group-prepend">
                  <span class="input-group-text"><i class="far fa-calendar-alt open-fecha-desde"></i></span>
                </div>
                <input type="text" value="" maxlength="10" size="10" class="form-control pull-right" id="fecha_desde" name="fecha_desde" placeholder="yyyy-mm-dd" required>
            </div>
        </div>
        <div class="form-group fecha-hasta" >
            <label for="fecha_hasta" >Fecha Hasta *</label>
            <div class="input-group date" style="width:200px" >
                <div class="input-group-prepend">
                  <span class="input-group-text"><i class="far fa-calendar-alt open-fecha-hasta "></i></span>
                </div>
                <input type="text" value="" size="10"  maxlength="10" class="form-control pull-right" id="fecha_hasta" name="fecha_hasta" placeholder="yyyy-mm-dd" required>
            </div>
        </div>
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
        {{-- <div class="form-group" >
            <input name="excel" id="excel"  type="checkbox" value="1" class="flat-red pull-right" > Generar Excel
        </div> --}}
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
      var today = new Date(); var dd = today.getDate(); var mm = today.getMonth()+1; var yyyy = today.getFullYear();
      if(dd<10){ dd='0'+dd; }
      if(mm<10){mm='0'+mm;}
      today = yyyy+'-'+mm+'-'+dd;
      $("#fecha_desde").val(today);
      $("#fecha_hasta").val(today);   
      $("#menuReporteComorbilidad" ).addClass("menu-open" );
      $("#menuReporte5" ).addClass("active" );   
      $('#fecha_desde').datepicker({ autoclose: true,format:'yyyy-mm-dd',defaultViewDate:'today',todayHighlight:true,todayBtn:true
                ,enableOnReadonly:true,language:'es'
                ,container:'#panelFechas'
        }).on('changeDate', function(e) {});
        $('#fecha_hasta').datepicker({ autoclose: true,format:'yyyy-mm-dd',defaultViewDate:'today',todayHighlight:true,todayBtn:true
                ,enableOnReadonly:true,language:'es',
        }).on('changeDate', function(e) {});
        $('.open-fecha-desde').click(function(event){ event.preventDefault(); $('#fecha_desde').focus();});
        $('.open-fecha-hasta').click(function(event){ event.preventDefault(); $('#fecha_hasta').focus();});         

        
        $('#btnConsultar').on('click', function(e) {                         
                $('form[name=search-form]').attr('action','{!! route('reporte.estadosalud.generar.excel'); !!}');
                $("#search-form").unbind('submit').submit();  
        });
        
        
      
    });
    
    
  </script>
@endsection
