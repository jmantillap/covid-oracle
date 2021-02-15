@extends('layout')
@section('title','Usuarios No llenaron Formulario')
@section('titulopag','REPORTE')
@section('elcontrolador','REPORTES')
@section('laaccion','Usuarios que no llenaron formulario')
@section('content')
@include('partials.session-status')

<div class="card">
    <div class="card-header">
         <form method="post" id="search-form" name="search-form" data-toggle="validator" class="formulario"   role="form">
          @csrf
        <div class="row">
          <div class="col-sm">
            <label id="ld_ultimocontacto">
                Ingrese la Fecha que desea consultar
            </label>
            <input required size=200 class="form-control col-md-10" type="date" id="fecha_desde" name="fecha_desde" value="{{ old('fecha_desde') }}"><br>
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
                        {{-- <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-label="Jefe: activate to sort column ascending" style="width: 320px;">Id Sigaa</th> --}}
                        <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-label="Activo: activate to sort column ascending" style="width: 50px;">Cod</th>                        
                        <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-label="Jefe: activate to sort column ascending" style="width: 320px;"># Documento</th>                  
                       <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-label="Usuario: activate to sort column ascending" style="width: 176px;">Nombres</th>
                       <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-label="Resultado: activate to sort column ascending" style="width: 176px;">Apellidos</th>
                       <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-label="Ingreso: activate to sort column ascending" style="width: 176px;">Teléfono</th>
                       <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-label="Ingreso: activate to sort column ascending" style="width: 176px;">E-mail</th>
                       <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-label="Resultado: activate to sort column ascending" style="width: 176px;">Sede</th>
                       <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-label="Ingreso: activate to sort column ascending" style="width: 176px;">Ciudad</th>
                       <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-label="Sitios: activate to sort column ascending" style="width: 176px;">Vínculo</th>
                       <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-label="Sitios: activate to sort column ascending" style="width: 176px;">ID SIGAA</th>
                       <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-label="Sitios: activate to sort column ascending" style="width: 176px;">Jefe</th>
                       <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-label="Sitios: activate to sort column ascending" style="width: 176px;">Empresa</th>
                      
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
      $("#menuReporte4" ).addClass("active" );
      $("#menuReportes" ).addClass("menu-open" );
      otable=$('#example1').DataTable({
        'paging' : true,'ordering': true,
          "searching": true,"processing": false,"serverSide": true,"info": false,
          "language": { "url": "/bower_components/datatables.net/locale/Spanish.json"},
          "ajax": {
                  url: '{!! route('reporteador4'); !!}',
                  data: function (d) {
                      d.fecha_desde = $('input[name=fecha_desde]').val();
                      }
              },
          "columns": [            
            {data: 'c_codtipo' },            
            {data: 't_documento' },
            {data: 't_nombres' },
            {data: 't_apellidos' },
            {data: 't_telefono' },
            {data: 't_email' },
            {data: 't_sede' },
            {data: 't_nombre' },
            {data: 't_vinculo' },
            {data: 't_idsigaa' },
            {data: 't_jefeinmediatocontacto' },
            {data: 't_facultadareaempresa' },
            ],
          "language": { "url": "/plugins/datatables/locale/Spanish.json",},
          dom: 'lfBrtip',
          "order": [[ 0, "desc" ]],		
          buttons: [
            {
                 extend: 'copy',
                 exportOptions: {
                 columns: [  0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11 ] //Your Colume value those you want
                     }
                   },
                  {
                 extend: 'print',
                 orientation: 'landscape',
                 exportOptions: {
                 columns: [ 0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11] //Your Colume value those you want
                     }
                   },
                   {
                    extend: 'excel',
                    exportOptions: {
                    columns: [ 0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11 ] //Your Colume value those you want
                   }
                 },
                 {
                    extend: 'pdf',
                    orientation: 'landscape',
                    exportOptions: {
                    columns: [  0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11,12 ] //Your Colume value those you want
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

