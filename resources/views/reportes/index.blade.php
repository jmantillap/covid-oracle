@extends('layout')
@section('title','Reporte Personas Críticas Por Periodo')
@section('titulopag','REPORTE')
@section('elcontrolador','REPORTES')
@section('laaccion','Personas Críticas (Sospechosas) por Periodo')
@section('content')
@include('partials.session-status')

<div class="card">
    <div class="card-header">
         <form method="post" id="search-form" name="search-form" data-toggle="validator" class="formulario"   role="form">
          @csrf
        <div class="row">
          <div class="col-sm">
            <label id="ld_ultimocontacto">
                Ingrese la Fecha Inicial del periodo
            </label>
            <input required size=200 class="form-control col-md-10" type="date" id="fecha_desde" name="fecha_desde" value="{{ old('fecha_desde') }}"><br>
          </div>
          <div class="col-sm">
            <label id="ld_ultimocontacto">
            Ingrese la Fecha Final del Periodo
            </label>
            <input required size=40 class="form-control col-md-10" type="date" id="fecha_hasta" name="fecha_hasta" value="{{ old('fechahasta') }}"><br>
          </div>
          <div class="col-sm">
            <button class="btn btn-info" type="submit">Consultar</button>
          </div>
        </div>
      </form>
    </div>
    <!-- /.card-header -->
    <div class="card-body">
            <table id="example1" class="table display responsive nowrap datatable" role="grid" aria-describedby="example1_info">
                    <thead>
                    <tr role="row">                        
                        <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-label="Activo: activate to sort column ascending" style="width: 50px;">Activo</th>
                        <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-label="Jefe: activate to sort column ascending" style="width: 320px;">Fecha y Hora de Presentación</th>
                  
                       <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-label="Usuario: activate to sort column ascending" style="width: 176px;">Usuario</th>
                       <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-label="Resultado: activate to sort column ascending" style="width: 176px;">Resultado</th>
                       <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-label="Ingreso: activate to sort column ascending" style="width: 176px;">Aprobado Ingreso</th>
                       <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-label="Ingreso: activate to sort column ascending" style="width: 176px;">Sede</th>
                       <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-label="Resultado: activate to sort column ascending" style="width: 176px;">Consent.</th>
                       <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-label="Ingreso: activate to sort column ascending" style="width: 176px;">Irá Hoy</th>
                       <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-label="Sitios: activate to sort column ascending" style="width: 176px;">Sitios</th>
                       <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-label="Sitios: activate to sort column ascending" style="width: 176px;">Actividades</th>
                       <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-label="Sitios: activate to sort column ascending" style="width: 176px;">Fiebre</th>
                       <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-label="Sitios: activate to sort column ascending" style="width: 176px;">Dolor Garganta</th>
                       <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-label="Sitios: activate to sort column ascending" style="width: 176px;">Malestar General</th>
                       <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-label="Sitios: activate to sort column ascending" style="width: 176px;">Secresión Nasal</th>
                       <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-label="Sitios: activate to sort column ascending" style="width: 176px;">Dificultad Respirar</th>
                       
                       <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-label="Sitios: activate to sort column ascending" style="width: 176px;">Tos Seca</th>
                       <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-label="Sitios: activate to sort column ascending" style="width: 176px;">Contacto Personas Infectadas</th>
                       <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-label="Sitios: activate to sort column ascending" style="width: 176px;">Fecha Último Contacto</th>
                       <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-label="Sitios: activate to sort column ascending" style="width: 176px;">Realizó Viaje</th>
                    </tr>
                    </thead>
                    <tbody></tbody>
            </table>                 
    </div>
    <!-- /.card-body -->
  </div>

@endsection

@section('script-custom')
<script>
  var otable=null;
  $(document).ready(function() {
      $("#menuReporte1" ).addClass("active" );
      $("#menuReportes" ).addClass("menu-open" );
      otable=$('#example1').DataTable({
        'paging' : true,'ordering': true,
          "searching": true,"processing": false,"serverSide": true,"info": false,
          "language": { "url": "/bower_components/datatables.net/locale/Spanish.json"},
          "ajax": {
                  url: '{!! route('reporteador1'); !!}',
                  data: function (d) {
                      d.fecha_desde = $('input[name=fecha_desde]').val();
                      d.fecha_hasta = $('input[name=fecha_hasta]').val();
                  }
              },
          "columns": [
            {data: 'activo' },
            {data: 'fechacreated' },
            {data: 'nombrec' },
            {data: 'semaforo' },
            {data: 'ingreso' },
            {data: 't_sede' },
            {data: 't_consentimiento' },
            {data: 't_irahoy' },
            {data: 't_sitios' },
            {data: 't_actividades' },
            {data: 't_presentadofiebre' },
            {data: 't_dolorgarganta' },
            {data: 't_malestargeneral' },
            {data: 't_secresioncongestionnasal' },
            {data: 't_dificultadrespirar' },
            {data: 't_tosseca' },
            {data: 't_contactopersonasinfectadas' },
            {data: 'd_ultimocontacto' },
            {data: 't_realizoviaje' },


            ],
          "language": { "url": "/plugins/datatables/locale/Spanish.json",},
          dom: 'lfBrtip',
          "order": [[ 0, "desc" ]],		
          buttons: [
            {
                 extend: 'copy',
                 exportOptions: {
                 columns: [  0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14, 15, 16, 17, 18 ] //Your Colume value those you want
                     }
                   },
                  {
                 extend: 'print',
                 orientation: 'landscape',
                 exportOptions: {
                 columns: [ 0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14, 15, 16, 17, 18 ] //Your Colume value those you want
                     }
                   },
                   {
                    extend: 'excel',
                    exportOptions: {
                    columns: [ 0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14, 15, 16, 17, 18 ] //Your Colume value those you want
                   }
                 },
                 {
                    extend: 'pdf',
                    orientation: 'landscape',
                    exportOptions: {
                    columns: [  0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14, 15, 16, 17, 18 ] //Your Colume value those you want
                   }
                 },
               ],
          aLengthMenu: [
          [10, 50, 100, 200, -1],
          [10, 50, 100, 200, "All"]
      ],
      iDisplayLength: 10,
          
      } );

      $('#search-form').on('submit', function(e) {
            e.preventDefault();
            console.log('Entro');
            otable.draw();   
                
       });

     });
  </script>
@endsection

