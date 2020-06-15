


@extends('layout')

@section('title','Sedes')
@section('titulopag','SEDES')
@section('elcontrolador','SEDES')
@section('laaccion','listado')
    



@section('content')

@include('partials.session-status')


<script>
        $(document).ready(function() {
            $('#example1').DataTable( {
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
                       columns: [  0, 1, 2 ] //Your Colume value those you want
                           }
                         },
                        {
                       extend: 'print',
                       exportOptions: {
                       columns: [  0, 1, 2  ] //Your Colume value those you want
                           }
                         },
                         {
                          extend: 'excel',
                          exportOptions: {
                          columns: [  0, 1, 2  ] //Your Colume value those you want
                         }
                       },
                       {
                          extend: 'pdf',
                          exportOptions: {
                          columns: [  0, 1, 2  ] //Your Colume value those you want
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
      <h3 class="card-title">Listado de Sedes</h3>
    </div>
    <!-- /.card-header -->
    <div class="card-body">
            <table id="example1" class="table table-bordered table-striped dataTable" role="grid" aria-describedby="example1_info">
                    <thead>
                    <tr role="row">
                        <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-label="FAcultad: activate to sort column ascending" style="width: 359px;">Sede</th>
                        <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-label="Escuela: activate to sort column ascending" style="width: 359px;">Ciudad</th>

                        <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-label="Jefe: activate to sort column ascending" style="width: 320px;">Fecha Actualización</th>
                        <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-label="CSS grade: activate to sort column ascending" style="width: 176px;">Seleccionar</th>
                    </tr>
                    </thead>
                    <tbody>
                           
                        @forelse ($sedes as $sedeitem)
                    
                    <tr role="row" class="odd">
                      
                      <td>{{ $sedeitem->t_sede }}</td>
                      <td>{{ $sedeitem->ciudad->t_nombre ?? '' }} </td>
                      <td>{{ $sedeitem->updated_at }}</td>
                      
                      
                      <td><a href="{{ route('sedes.show', $sedeitem->n_idsede) }} "> Ver</a></td>
                    </tr>
            
                    @empty
                    <tr></td colspan=5>No hay sedes para mostrar</td></tr>
                
                    @endforelse
                
                    </tbody>
                
                    
                  </table>
                  {{ $sedes->links() }}
    </div>
    <!-- /.card-body -->
  </div>




<a href="{{ route('sedes.create') }}" class="btn  btn-danger btn-xs">Crear Sede</a><br>

@endsection

@section('script-custom')
<script>
    $(function () {      
      $("#menuSedes" ).addClass("active" );
      $("#menuTablas" ).addClass("menu-open" );
      
     });
  </script>
@endsection

