@extends('layout')
@section('title','Formulario')
@section('titulopag','FORMULARIO')
@section('elcontrolador','FORMULARIO')
@section('laaccion','Listado')
@section('content')
@include('partials.session-status')
<script>
  $(document).ready(function() {
      $('#example1').DataTable( {
          responsive: true,
          "serverSide": true,
          "ajax": "{{ url('losformularios') }}",
          "columns": [
              {data: 'action' }, 
              {data: 'activo' },              
              {data: 'fecha_creacion' },                          
              {data: 'nombrec' },
              {data: 'semaforo' },
              {data: 'ingreso' }
               ],
          language: {
          "decimal": "",
          "emptyTable": "No hay información",
          "info": "Mostrando _START_ a _END_ de _TOTAL_ Entradas ",
          "infoEmpty": "Mostrando 0 to 0 of 0 Entradas",
          "infoFiltered": "(Filtrado de _MAX_ total entradas)",
          "infoPostFix": "",
          "thousands": ",",
          "lengthMenu": "&nbsp;Mostrar _MENU_ Entradas ",
          "loadingRecords": "Cargando...",
          "processing": "Procesando...",
          "search": "&nbsp;Buscar:",
          "print": "&nbsp;Buscar:",
          "zeroRecords": "Sin resultados encontrados",
          "paginate": {
              "first": "Primero",
              "last": "Ultimo",
              "next": "Siguiente",
              "previous": "Anterior"
          }
      },
          dom: 'lfBrtip',
          "order": [[ 0, "desc" ]],		
          buttons: [
            {
                 extend: 'copy',
                 exportOptions: {
                 columns: [  0, 1, 2, 3, 4, 5 ] //Your Colume value those you want
                     }
                   },
                  {
                 extend: 'print',
                 exportOptions: {
                 columns: [ 0, 1, 2, 3, 4, 5 ] //Your Colume value those you want
                     }
                   },
                   {
                    extend: 'excel',
                    exportOptions: {
                    columns: [ 0, 1, 2, 3, 4, 5 ] //Your Colume value those you want
                   }
                 },
                 {
                    extend: 'pdf',
                    exportOptions: {
                    columns: [  0 , 1, 2, 3, 4, 5 ] //Your Colume value those you want
                   }
                 },
               ],
          aLengthMenu: [
          [10, 50, 100, 200, -1],
          [10, 50, 100, 200, "All"]
      ],
      iDisplayLength: 10          
      } );
  } );
</script>
<?php 

//echo DNS1D::getBarcodeHTML("000001", "C128");
//echo '<br>';
//echo DNS1D::getBarcodeHTML("056914", "C128A",1.5,40,"green", true);

?>

<div class="card">
    <div class="card-header">
      <h3 class="card-title">Listado de Formularios a los que tiene acceso. Diligenciados el día de Hoy: <strong> <?php echo date('Y-m-d');?></strong></h3>
    </div>
    <!-- /.card-header -->
    <div class="card-body">
            <table id="example1" class="table table-bordered table-striped dataTable" role="grid" aria-describedby="example1_info">
                    <thead>
                    <tr role="row">
                        <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-label="Accion: activate to sort column ascending" style="width: 50px;">Acción</th>
                        <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-label="Activo: activate to sort column ascending" style="width: 50px;">Activo</th>
                        <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-label="Jefe: activate to sort column ascending" style="width: 320px;">Fecha y Hora de Presentación</th>
                  
                       <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-label="Usuario: activate to sort column ascending" style="width: 176px;">Usuario</th>
                        <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-label="Resultado: activate to sort column ascending" style="width: 176px;">Resultado</th>
                        <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-label="Ingreso: activate to sort column ascending" style="width: 176px;">Ingresó</th>
                    </tr>
                    </thead>
                    
                
                    
                  </table>
                  {{ $sedes->links() }}
    </div>
    <!-- /.card-body -->
  </div>

@endsection

@section('script-custom')
<script>
    $(function () {      
      $("#menuInactivar" ).addClass("active" );
     });
  </script>
@endsection

