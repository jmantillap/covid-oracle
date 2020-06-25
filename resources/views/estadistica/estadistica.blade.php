@php
    $ciudad='';
    if(auth()->user()->ciudad!=null){
      $ciudad=auth()->user()->ciudad->t_nombre;
    }
@endphp

@extends('layout')
@section('title','Formulario COVID-19' )
@section('titulopag','ESTADISTICAS')
@section('elcontrolador','Menu')
@section('laaccion','Estadistica : '.$ciudad )
@section('content')
{{-- /**
 * Javier Mantilla. javier.mantillap@upb.edu.co
 * 2020-06
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
        <div class="form-group" >
            <input name="excel" id="excel"  type="checkbox" value="1" class="flat-red pull-right" > Generar Excel
        </div>
    </div>
    <div class="card-footer">        
        <button id="btnConsultar" type="submit" class="btn btn-info pull-right">Consultar</button>
    </div>
  </div> 
  </form>      
</div>
<div class="row">
  <section class="col-lg-4 connectedSortable">
    <div class="">
        <div class="card card-info">
            <div class="card-header with-border">
              <h3 class="card-title">{{ Config::get('pregunta.fiebre') }}</h3>
              <div class="card-tools">
                <button type="button" class="btn btn-tool btn-sm" data-card-widget="collapse" data-toggle="tooltip" title="Collapse">
                  <i class="fas fa-minus"></i></button>                
              </div>
            </div>
            <div class="card-body">
              <div id="graph-container-fiebre" class="chart">              
                  <canvas id="barChartFiebre" style="min-height: 250px; height: 250px; max-height: 250px; max-width: 100%;"></canvas>
              </div>
            </div>
            <!-- /.box-body -->
          </div>
    </div>
  </section>  
  <section class="col-lg-4 connectedSortable">
    <div class="">
        <div class="card card-navy">
            <div class="card-header with-border">
              <h3 class="card-title">{{ Config::get('pregunta.secrecion') }}</h3>
              <div class="card-tools">
                <button type="button" class="btn btn-tool btn-sm" data-card-widget="collapse" data-toggle="tooltip" title="Collapse">
                  <i class="fas fa-minus"></i></button>                
              </div>
            </div>
            <div class="card-body">
              <div id="graph-container-secrecion" class="chart">              
                  <canvas id="barChartSecrecion" style="min-height: 250px; height: 250px; max-height: 250px; max-width: 100%;"></canvas>
              </div>
            </div>
            <!-- /.box-body -->
          </div>
    </div>
  </section> 
  <section class="col-lg-4 connectedSortable">
    <div class="">
        <div class="card card-secondary">
            <div class="card-header with-border">
              <h3 class="card-title">{{ Config::get('pregunta.viaje') }}</h3>
              <div class="card-tools">
                <button type="button" class="btn btn-tool btn-sm" data-card-widget="collapse" data-toggle="tooltip" title="Collapse">
                  <i class="fas fa-minus"></i></button>                
              </div>
            </div>
            <div class="card-body">
              <div id="graph-container-viaje" class="chart">              
                  <canvas id="barChartViaje" style="min-height: 250px; height: 250px; max-height: 250px; max-width: 100%;"></canvas>
              </div>
            </div>
            <!-- /.box-body -->
          </div>
    </div>
  </section> 
  <section class="col-lg-4 connectedSortable">
    <div class="">
        <div class="card card-olive">
            <div class="card-header with-border">
              <h3 class="card-title">{{ Config::get('pregunta.garganta') }}</h3>
              <div class="card-tools">
                <button type="button" class="btn btn-tool btn-sm" data-card-widget="collapse" data-toggle="tooltip" title="Collapse">
                  <i class="fas fa-minus"></i></button>                
              </div>
            </div>
            <div class="card-body">
              <div id="graph-container-garganta" class="chart">              
                  <canvas id="barChartGarganta" style="min-height: 250px; height: 250px; max-height: 250px; max-width: 100%;"></canvas>
              </div>
            </div>
            <!-- /.box-body -->
          </div>
    </div>
  </section> 
  <section class="col-lg-4 connectedSortable">
    <div class="">
        <div class="card card-lightblue">
            <div class="card-header with-border">
              <h3 class="card-title">{{ Config::get('pregunta.malestar') }}</h3>
              <div class="card-tools">
                <button type="button" class="btn btn-tool btn-sm" data-card-widget="collapse" data-toggle="tooltip" title="Collapse">
                  <i class="fas fa-minus"></i></button>                
              </div>
            </div>
            <div class="card-body">
              <div id="graph-container-malestar" class="chart">              
                  <canvas id="barChartMalestar" style="min-height: 250px; height: 250px; max-height: 250px; max-width: 100%;"></canvas>
              </div>
            </div>
            <!-- /.box-body -->
          </div>
    </div>
  </section> 
  <section class="col-lg-4 connectedSortable">
    <div class="">
        <div class="card card-orange">
            <div class="card-header with-border">
              <h3 class="card-title">{{ Config::get('pregunta.respirar') }}</h3>
              <div class="card-tools">
                <button type="button" class="btn btn-tool btn-sm" data-card-widget="collapse" data-toggle="tooltip" title="Collapse">
                  <i class="fas fa-minus"></i></button>                
              </div>
            </div>
            <div class="card-body">
              <div id="graph-container-respirar" class="chart">              
                  <canvas id="barChartRespirar" style="min-height: 250px; height: 250px; max-height: 250px; max-width: 100%;"></canvas>
              </div>
            </div>
            <!-- /.box-body -->
          </div>
    </div>
  </section>
  <section class="col-lg-4 connectedSortable">
    <div class="">
        <div class="card card-purple">
            <div class="card-header with-border">
              <h3 class="card-title">{{ Config::get('pregunta.tos') }}</h3>
              <div class="card-tools">
                <button type="button" class="btn btn-tool btn-sm" data-card-widget="collapse" data-toggle="tooltip" title="Collapse">
                  <i class="fas fa-minus"></i></button>                
              </div>
            </div>
            <div class="card-body">
              <div id="graph-container-tos" class="chart">              
                  <canvas id="barChartTos" style="min-height: 250px; height: 250px; max-height: 250px; max-width: 100%;"></canvas>
              </div>
            </div>
            <!-- /.box-body -->
          </div>
    </div>
  </section>
  <section class="col-lg-8 connectedSortable">
    <div class="">
        <div class="card card-success">
            <div class="card-header with-border">
              <h3 class="card-title">{{ Config::get('pregunta.contacto') }}</h3>
              <div class="card-tools">
                <button type="button" class="btn btn-tool btn-sm" data-card-widget="collapse" data-toggle="tooltip" title="Collapse">
                  <i class="fas fa-minus"></i></button>                
              </div>
            </div>
            <div class="card-body">
              <div id="graph-container-contacto" class="chart">              
                  <canvas id="barChartContacto" style="min-height: 250px; height: 250px; max-height: 250px; max-width: 100%;"></canvas>
              </div>
            </div>
            <!-- /.box-body -->
          </div>
    </div>
  </section> 
</div>
@endsection
@section('script-custom')
<script src="/plugins/chart.js/Chart.min.js"></script>
<link rel="stylesheet" href="/plugins/chart.js/Chart.min.css">
<script>
    var barChartFiebre=null; var barChartSecrecion=null; var barChartViaje=null;
    var barChartGarganta=null;    var barChartMalestar=null;
    var barChartRespirar=null;    var barChartTos=null;
    var barChartContacto=null;
    $(function () {   
      var today = new Date(); var dd = today.getDate(); var mm = today.getMonth()+1; var yyyy = today.getFullYear();
      if(dd<10){ dd='0'+dd; }
      if(mm<10){mm='0'+mm;}
      today = yyyy+'-'+mm+'-'+dd;
      $("#fecha_desde").val(today);
      $("#fecha_hasta").val(today);   
      $("#menuEstadistica" ).addClass("active" );   
      $('#fecha_desde').datepicker({ autoclose: true,format:'yyyy-mm-dd',defaultViewDate:'today',todayHighlight:true,todayBtn:true
                ,enableOnReadonly:true,language:'es'
                ,container:'#panelFechas'
        }).on('changeDate', function(e) {});
        $('#fecha_hasta').datepicker({ autoclose: true,format:'yyyy-mm-dd',defaultViewDate:'today',todayHighlight:true,todayBtn:true
                ,enableOnReadonly:true,language:'es',
        }).on('changeDate', function(e) {});
        $('.open-fecha-desde').click(function(event){ event.preventDefault(); $('#fecha_desde').focus();});
        $('.open-fecha-hasta').click(function(event){ event.preventDefault(); $('#fecha_hasta').focus();});         

        //$("#inmueble_cliente").autocomplete("option", "appendTo", "#modal-detalle");
        

        $('#search-form').on('submit', function(e) {               
               if($('input:checkbox[name=excel]:checked').val()!=1){
                  e.preventDefault();                
                  cargarDatosGraficaFiebre(); cargarDatosGraficaSecrecion(); cargarDatosGraficaViaje();
                  cargarDatosGraficaGarganta(); cargarDatosGraficaMalestar(); cargarDatosGraficaRespirar();
                  cargarDatosGraficaTos(); cargarDatosGraficaContacto();
               }else{
                  $('form[name=search-form]').attr('action','{!! route('estadistica.generar.excel'); !!}');
                  $("#search-form").unbind('submit').submit();  
               }
               
        });
        $('#excel').on('ifChecked', function(event){
             $("#btnConsultar").text("Generar Excel");
        });
       $('#excel').on('ifUnchecked', function(event){
            $("#btnConsultar").text("Consultar");
            $('#btnConsultar').removeAttr("disabled");
            document.location.href="{!! route('estadistica'); !!}";
        });
        if($('input[name=fecha_desde]').val()!='' && $('input[name=fecha_hasta]').val()!=''){
            cargarDatosGraficaFiebre(); cargarDatosGraficaSecrecion(); cargarDatosGraficaViaje();
            cargarDatosGraficaGarganta(); cargarDatosGraficaMalestar(); cargarDatosGraficaRespirar();
            cargarDatosGraficaTos(); cargarDatosGraficaContacto();
        }else{
            graficaBarChart("#barChartFiebre",['N/A'], [0],[0]);            graficaBarChart("#barChartSecrecion",['N/A'], [0],[0]);
            graficaBarChart("#barChartViaje",['N/A'], [0],[0]);            graficaBarChart("#barChartGarganta",['N/A'], [0],[0]);
            graficaBarChart("#barChartMalestar",['N/A'], [0],[0]); graficaBarChart("#barChartRespirar",['N/A'], [0],[0]);
            graficaBarChart("#barChartTos",['N/A'], [0],[0]); graficaBarChart("#barChartContacto",['N/A'], [0],[0]);
        }
      
    });

    function cargarDatosGraficaFiebre() {
            var cantidadSi = []; var cantidadNo = [];var ciudad=[];
            $.ajax({
                url : '{{ route('estadistica.fiebre.grafico.ajax') }}',
                data : {'_token': $('input[name=_token]').val(),'fecha_desde': $('input[name=fecha_desde]').val(), 
                         'fecha_hasta': $('input[name=fecha_hasta]').val(),'todas':$('input:checkbox[name=todas]:checked').val(),'id_tipo': $('#n_idvinculou').val(), 
                       },
                type : 'GET', dataType : 'json',
                success : function(response) {
                    response.forEach(function(obj) {
                            ciudad.push(obj.ciudad); cantidadSi.push(obj.si); cantidadNo.push(obj.no);
                    });
                },
                error : function(xhr, status) { 
                    console.log(JSON.stringify(xhr)); console.log("AJAX error: " + status);
                    //errorAlert('Error','Disculpe, existió un problema'); 
                  },
                complete : function(xhr, status) {
                   if(barChartFiebre!=null){ resetCanvas('barChartFiebre','#graph-container-fiebre'); }  
                   graficaBarChart("#barChartFiebre",ciudad,cantidadSi,cantidadNo);
                }
            });
    }

    function  cargarDatosGraficaSecrecion(){
            var cantidadSi = []; var cantidadNo = [];var ciudad=[];
            $.ajax({
                url : '{{ route('estadistica.secrecion.grafico.ajax') }}',
                data : {'_token': $('input[name=_token]').val(),'fecha_desde': $('input[name=fecha_desde]').val(), 
                         'fecha_hasta': $('input[name=fecha_hasta]').val(),'todas':$('input:checkbox[name=todas]:checked').val(),'id_tipo': $('#n_idvinculou').val(),
                       },
                type : 'GET', dataType : 'json',
                success : function(response) {
                    response.forEach(function(obj) {
                            ciudad.push(obj.ciudad); cantidadSi.push(obj.si); cantidadNo.push(obj.no);
                    });
                },
                error : function(xhr, status) { 
                    //errorAlert('Error','Disculpe, existió un problema'); 
                    console.log(JSON.stringify(xhr)); console.log("AJAX error: " + status);
                 },
                complete : function(xhr, status) {
                   if(barChartSecrecion!=null){ resetCanvas('barChartSecrecion','#graph-container-secrecion'); }  
                   graficaBarChart("#barChartSecrecion",ciudad,cantidadSi,cantidadNo);
                }
            });
    }

    function  cargarDatosGraficaViaje(){
            var cantidadSi = []; var cantidadNo = [];var ciudad=[];
            $.ajax({
                url : '{{ route('estadistica.viaje.grafico.ajax') }}',
                data : {'_token': $('input[name=_token]').val(),'fecha_desde': $('input[name=fecha_desde]').val(), 
                         'fecha_hasta': $('input[name=fecha_hasta]').val(),'todas':$('input:checkbox[name=todas]:checked').val(),'id_tipo': $('#n_idvinculou').val(),
                       },
                type : 'GET', dataType : 'json',
                success : function(response) {
                    response.forEach(function(obj) {
                            ciudad.push(obj.ciudad); cantidadSi.push(obj.si); cantidadNo.push(obj.no);
                    });
                },
                error : function(xhr, status) { 
                    //errorAlert('Error','Disculpe, existió un problema'); 
                    console.log(JSON.stringify(xhr)); console.log("AJAX error: " + status);
                 },
                complete : function(xhr, status) {
                   if(barChartViaje!=null){ resetCanvas('barChartViaje','#graph-container-viaje'); }  
                   graficaBarChart("#barChartViaje",ciudad,cantidadSi,cantidadNo);
                }
            });
    }

    function  cargarDatosGraficaGarganta(){
            var cantidadSi = []; var cantidadNo = [];var ciudad=[];
            $.ajax({
                url : '{{ route('estadistica.garganta.grafico.ajax') }}',
                data : {'_token': $('input[name=_token]').val(),'fecha_desde': $('input[name=fecha_desde]').val(), 
                         'fecha_hasta': $('input[name=fecha_hasta]').val(),'todas':$('input:checkbox[name=todas]:checked').val(),'id_tipo': $('#n_idvinculou').val(),
                       },
                type : 'GET', dataType : 'json',
                success : function(response) {
                    response.forEach(function(obj) {
                            ciudad.push(obj.ciudad);  cantidadSi.push(obj.si); cantidadNo.push(obj.no);
                    });
                },
                error : function(xhr, status) { 
                    //errorAlert('Error','Disculpe, existió un problema'); 
                    console.log(JSON.stringify(xhr)); console.log("AJAX error: " + status);
                },
                complete : function(xhr, status) {
                   if(barChartGarganta!=null){ resetCanvas('barChartGarganta','#graph-container-garganta'); }  
                   graficaBarChart("#barChartGarganta",ciudad,cantidadSi,cantidadNo);
                }
            });
    }

    function  cargarDatosGraficaMalestar(){
            var cantidadSi = []; var cantidadNo = [];var ciudad=[];
            $.ajax({
                url : '{{ route('estadistica.malestar.grafico.ajax') }}',
                data : {'_token': $('input[name=_token]').val(),'fecha_desde': $('input[name=fecha_desde]').val(), 
                         'fecha_hasta': $('input[name=fecha_hasta]').val(),'todas':$('input:checkbox[name=todas]:checked').val(),'id_tipo': $('#n_idvinculou').val(),
                       },
                type : 'GET', dataType : 'json',
                success : function(response) {
                    response.forEach(function(obj) {
                            ciudad.push(obj.ciudad);  cantidadSi.push(obj.si); cantidadNo.push(obj.no);
                    });
                },
                error : function(xhr, status) { 
                    //errorAlert('Error','Disculpe, existió un problema'); 
                    console.log(JSON.stringify(xhr)); console.log("AJAX error: " + status);
                },
                complete : function(xhr, status) {
                   if(barChartMalestar!=null){ resetCanvas('barChartMalestar','#graph-container-malestar'); }  
                   graficaBarChart("#barChartMalestar",ciudad,cantidadSi,cantidadNo);
                }
            });
    }

    function  cargarDatosGraficaRespirar(){
            var cantidadSi = []; var cantidadNo = [];var ciudad=[];
            $.ajax({
                url : '{{ route('estadistica.respirar.grafico.ajax') }}',
                data : {'_token': $('input[name=_token]').val(),'fecha_desde': $('input[name=fecha_desde]').val(), 
                         'fecha_hasta': $('input[name=fecha_hasta]').val(),'todas':$('input:checkbox[name=todas]:checked').val(),'id_tipo': $('#n_idvinculou').val(),
                       },
                type : 'GET', dataType : 'json',
                success : function(response) {
                    response.forEach(function(obj) {
                            ciudad.push(obj.ciudad);  cantidadSi.push(obj.si); cantidadNo.push(obj.no);
                    });
                },
                error : function(xhr, status) { 
                    //errorAlert('Error','Disculpe, existió un problema'); 
                    console.log(JSON.stringify(xhr)); console.log("AJAX error: " + status);
                },
                complete : function(xhr, status) {
                   if(barChartRespirar!=null){ resetCanvas('barChartRespirar','#graph-container-respirar'); }  
                   graficaBarChart("#barChartRespirar",ciudad,cantidadSi,cantidadNo);
                }
            });
    }

    function  cargarDatosGraficaTos(){
            var cantidadSi = []; var cantidadNo = [];var ciudad=[];
            $.ajax({
                url : '{{ route('estadistica.tos.grafico.ajax') }}',
                data : {'_token': $('input[name=_token]').val(),'fecha_desde': $('input[name=fecha_desde]').val(), 
                         'fecha_hasta': $('input[name=fecha_hasta]').val(),'todas':$('input:checkbox[name=todas]:checked').val(),'id_tipo': $('#n_idvinculou').val(),
                       },
                type : 'GET', dataType : 'json',
                success : function(response) {
                    response.forEach(function(obj) {
                            ciudad.push(obj.ciudad);  cantidadSi.push(obj.si); cantidadNo.push(obj.no);
                    });
                },
                error : function(xhr, status) { 
                    //errorAlert('Error','Disculpe, existió un problema'); 
                    console.log(JSON.stringify(xhr)); console.log("AJAX error: " + status);
                },
                complete : function(xhr, status) {
                   if(barChartTos!=null){ resetCanvas('barChartTos','#graph-container-tos'); }  
                   graficaBarChart("#barChartTos",ciudad,cantidadSi,cantidadNo);
                }
            });
    }

    function  cargarDatosGraficaContacto(){
            var cantidadSi = []; var cantidadNo = [];var ciudad=[];
            $.ajax({
                url : '{{ route('estadistica.contacto.grafico.ajax') }}',
                data : {'_token': $('input[name=_token]').val(),'fecha_desde': $('input[name=fecha_desde]').val(), 
                         'fecha_hasta': $('input[name=fecha_hasta]').val(),'todas':$('input:checkbox[name=todas]:checked').val(),'id_tipo': $('#n_idvinculou').val(),
                       },
                type : 'GET', dataType : 'json',
                success : function(response) {
                    response.forEach(function(obj) {
                            ciudad.push(obj.ciudad);  cantidadSi.push(obj.si); cantidadNo.push(obj.no);
                    });
                },
                error : function(xhr, status) { 
                    //errorAlert('Error','Disculpe, existió un problema'); 
                    console.log(JSON.stringify(xhr)); console.log("AJAX error: " + status);
                },
                complete : function(xhr, status) {
                   if(barChartContacto!=null){ resetCanvas('barChartContacto','#graph-container-contacto'); }  
                   graficaBarChart("#barChartContacto",ciudad,cantidadSi,cantidadNo);
                }
            });
    }

    function graficaBarChart(nombreGrafica,ciudad,arraySi,arrayNo) {              
        var areaChartData = {
              labels  :ciudad,
              datasets: [
                {
                  label: 'Si',backgroundColor: 'rgba(207,0,15,0.9)',borderColor: 'rgba(207,0,15,0.8)',pointRadius: false,pointColor: '#CF000F',
                  pointStrokeColor: 'rgba(207,0,15,1)',pointHighlightFill: '#fff',pointHighlightStroke: 'rgba(207,0,15,1)',data: arraySi,
                },
                {
                  label: 'No',backgroundColor: 'rgba(210, 214, 222, 1)',borderColor: 'rgba(210, 214, 222, 1)',pointRadius: false,pointColor: 'rgba(210, 214, 222, 1)',
                  pointStrokeColor: '#c1c7d1',pointHighlightFill  : '#fff',pointHighlightStroke: 'rgba(220,220,220,1)',data: arrayNo
                },
              ]
        };        
        var barChartCanvas = $(nombreGrafica).get(0).getContext('2d');
        var barChartData = jQuery.extend(true, {}, areaChartData);
        var temp0 = areaChartData.datasets[0];
        var temp1 = areaChartData.datasets[1];
        barChartData.datasets[0] = temp1;
        barChartData.datasets[1] = temp0;
        var barChartOptions = {
          responsive              : true,maintainAspectRatio     : false, datasetFill             : false,          
          scales: {yAxes: [{ ticks: {beginAtZero: true,min: 0,}}]}
        };
        /* scales: {yAxes: [{ ticks: {beginAtZero: true,stepSize: 1,}}]} */
        if(nombreGrafica=="#barChartFiebre"){  barChartFiebre = new Chart(barChartCanvas, { type: 'bar', data: barChartData,options: barChartOptions }); }
        if(nombreGrafica=="#barChartSecrecion"){  barChartSecrecion = new Chart(barChartCanvas, { type: 'bar', data: barChartData,options: barChartOptions }); }
        if(nombreGrafica=="#barChartViaje"){  barChartViaje = new Chart(barChartCanvas, { type: 'bar', data: barChartData,options: barChartOptions }); }
        if(nombreGrafica=="#barChartGarganta"){  barChartGarganta = new Chart(barChartCanvas, { type: 'bar', data: barChartData,options: barChartOptions }); }
        if(nombreGrafica=="#barChartMalestar"){  barChartMalestar = new Chart(barChartCanvas, { type: 'bar', data: barChartData,options: barChartOptions }); }
        if(nombreGrafica=="#barChartRespirar"){  barChartRespirar = new Chart(barChartCanvas, { type: 'bar', data: barChartData,options: barChartOptions }); }
        if(nombreGrafica=="#barChartTos"){  barChartTos = new Chart(barChartCanvas, { type: 'bar', data: barChartData,options: barChartOptions }); }
        if(nombreGrafica=="#barChartContacto"){  barChartContacto = new Chart(barChartCanvas, { type: 'bar', data: barChartData,options: barChartOptions }); }
               
    }
    var resetCanvas = function(nombreGrafica,nombreContenedor){
          $('#'+nombreGrafica).remove(); // this is my <canvas> element
          $(nombreContenedor).append('<canvas id="'+nombreGrafica+'" style="height:230px" ><canvas>');
          canvas = document.querySelector('#'+nombreGrafica);
          ctx = canvas.getContext('2d');
          ctx.canvas.width = $('#graph').width(); // resize to parent width
          ctx.canvas.height = $('#graph').height(); // resize to parent height
          var x = canvas.width/2;
          var y = canvas.height/2;
          ctx.font = '10pt Verdana';
          ctx.textAlign = 'center';
          ctx.fillText('This text is centered on the canvas', x, y); 
        };
  </script>
@endsection

{{-- 
function graficaFiebre(ciudad,arraySi,arrayNo) {
  var nombreGrafica="#barChartFiebre";
  if(barChartFiebre!=null){
      //console.log("Entro a eliminar el canvas anterior");
      //barChart.clear();
      resetCanvas();
  }        
  //label: 'Si',backgroundColor: 'rgba(60,141,188,0.9)',borderColor: 'rgba(60,141,188,0.8)',pointRadius: false,pointColor: '#3b8bba',
      //pointStrokeColor: 'rgba(60,141,188,1)',pointHighlightFill: '#fff',pointHighlightStroke: 'rgba(60,141,188,1)',data: arraySi,
  var areaChartData = {    
    labels  :ciudad,
    datasets: [
      {
        label: 'Si', 
        backgroundColor: 'rgba(60,141,188,0.9)',
        borderColor: 'rgba(60,141,188,0.8)',
        pointRadius: false,
        pointColor: '#3b8bba',
        pointStrokeColor: 'rgba(60,141,188,1)',
        pointHighlightFill: '#fff',
        pointHighlightStroke: 'rgba(60,141,188,1)',
        data: arraySi,
      },
      {
        label: 'No',backgroundColor: 'rgba(210, 214, 222, 1)',borderColor: 'rgba(210, 214, 222, 1)',pointRadius: false,pointColor: 'rgba(210, 214, 222, 1)',
        pointStrokeColor: '#c1c7d1',pointHighlightFill  : '#fff',pointHighlightStroke: 'rgba(220,220,220,1)',data: arrayNo
      },
    ]
  }
  //var barChartCanvas = $('#barChartFiebre').get(0).getContext('2d');
  var barChartCanvas = $(nombreGrafica).get(0).getContext('2d');
  var barChartData = jQuery.extend(true, {}, areaChartData);
  var temp0 = areaChartData.datasets[0]
  var temp1 = areaChartData.datasets[1]
  barChartData.datasets[0] = temp1
  barChartData.datasets[1] = temp0
  var barChartOptions = {
    responsive              : true,
    maintainAspectRatio     : false,
    datasetFill             : false,
    scales: {yAxes: [{ ticks: {beginAtZero: true,stepSize: 1,}}]}
  }
  barChartFiebre = new Chart(barChartCanvas, {
                  type: 'bar', data: barChartData,options: barChartOptions
                })

}
var resetCanvas = function(){
    $('#barChartFiebre').remove(); // this is my <canvas> element
    $('#graph-container-fiebre').append('<canvas id="barChartFiebre" style="height:230px" ><canvas>');
    canvas = document.querySelector('#barChartFiebre');
    ctx = canvas.getContext('2d');
    ctx.canvas.width = $('#graph').width(); // resize to parent width
    ctx.canvas.height = $('#graph').height(); // resize to parent height
    var x = canvas.width/2;
    var y = canvas.height/2;
    ctx.font = '10pt Verdana';
    ctx.textAlign = 'center';
    ctx.fillText('This text is centered on the canvas', x, y); 
  }; --}}