


@extends('layout')

@section('title','USUARIOS')
@section('titulopag','USUARIOS')
@section('elcontrolador','USUARIOS')
@section('laaccion','Listado')
    



@section('content')
@auth
@include('partials.session-status')


<script>
    $(document).ready(function() {
        $('#example1').DataTable( {
            responsive: true,
            "serverSide": true,
            "ajax": "{{ url('losusuarios') }}",
            "columns": [
                {data: 'action' },             
                {data: 't_nombres' },
                {data: 't_apellidos' },                    
                {data: 'c_codtipo' },
                {data: 't_documento' },
                {data: 't_email' }, 
                {data: 't_telefono' },                     
                {data: 't_idsigaa' },
                

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
                   columns: [  1, 2, 3, 4, 5, 6 ] //Your Colume value those you want
                       }
                     },
                    {
                   extend: 'print',
                   exportOptions: {
                   columns: [  1, 2, 3, 4, 5, 6 ] //Your Colume value those you want
                       }
                     },
                     {
                      extend: 'excel',
                      exportOptions: {
                      columns: [  1, 2, 3, 4, 5, 6 ] //Your Colume value those you want
                     }
                   },
                   {
                      extend: 'pdf',
                      exportOptions: {
                      columns: [  1, 2, 3, 4, 5, 6 ] //Your Colume value those you want
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


<div class="card">
    <div class="card-header">
      <h3 class="card-title">Listado de Usuarios</h3>
    </div>
    <!-- /.card-header -->
    <div class="card-body">
            <table id="example1" class="table table-bordered table-striped dataTable" role="grid" aria-describedby="example1_info">
                    <thead>
                        <tr role="row">
                            <th class="sorting"    >Accion</th>
                              <th class="sorting"    >Nombres</th>
                              <th class="sorting"    >Apellidos</th>
                              <th class="sorting"    >Tipo</th>
                              <th class="sorting"    >Documento</th>
                              <th class="sorting"    >E-mail</th>
                              <th class="sorting"    >Teléfono</th>
                              <th class="sorting"    >ID SIGAA</th>
                              
                              
                              
                          </tr>
                    </thead>
                   
                
                    
                  </table>
                 
    </div>
    <!-- /.card-body -->
  </div>





@endauth
@endsection

@section('script-custom')
<script>
    $(function () {      
      $("#menuUsuario" ).addClass("active" );
     });
  </script>
@endsection

