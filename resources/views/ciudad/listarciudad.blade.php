@extends('layout')
@section('title','Formulario COVID-19' )
@section('titulopag','LISTADO DE CIUDADES')
@section('elcontrolador','Menu')
@section('laaccion','Ciudades')
@section('content')
{{-- /**
 * Javier Mantilla. javier.mantillap@upb.edu.co
 * 2020-06
 */ --}}
<div class="row">
    <div class="col-xs-12">
        <form action="{{ route('ciudad.listar.nuevo') }}" method="get">
            <button type="submit" class="btn btn-info pull-left">Nuevo</button>
        </form>
    </div>    
</div>    
<div class="table-responsive">
    <table id="listadoCiudad" class="table table-bordered table-striped tbl">
        <thead>
            <tr>
                <th class="text-center">Sel..</th>
                <th>ID</th><th>Nombre</th>                
                <th>Actualización</th>
                <th class="text-center">Estado</th>
            </tr>
        </thead>
        <tbody>
            @foreach($ciudades as $ciudad)
                <tr>
                    <td class="text-center">
                        <form method="POST" action="{{ route('ciudad.seleccionar') }}">
                            <input type="hidden" name="idCiudadSeleccionada" value="{{ $ciudad->n_id }}">
                            {!! csrf_field() !!}
                            <button type="submit" class="btn btn-primary">
                                <span class="fas fa-edit"></span>
                            </button>
                        </form>
                    </td>
                    <td>{{ $ciudad->n_id }}</td>
                    <td>{{ $ciudad->t_nombre }}</td>                                                            
                    <td>{{ $ciudad->dt_update_at }}</td>
                    <td class="text-center">
                        @if ($ciudad->b_habilitado == 1)
                            <span class="badge badge-success">Activo</span>
                        @else
                            <span class="badge badge-danger">Inactivo</span>
                        @endif
                    </td>
                </tr>
            @endforeach
        </tbody>
        <tfoot>
            
        </tfoot>
    </table>
</div>

@endsection
@section('script-custom')
<script>
    $(function () {      
        $("#menuCiudad" ).addClass("active" );
        $("#menuTablas" ).addClass("menu-open" );
      
      $('#listadoCiudad').DataTable({
        "paging": true,
        "lengthChange": false,
        "searching": true,
        "ordering": false,
        "info": true,
        "autoWidth": false,
        "responsive": true,
        "language": { "url": "/plugins/datatables/locale/Spanish.json",},
        "pageLength": 10,
        "lengthMenu": [[10, 25, 50,100, -1], [10, 25, 50,100, "All"]],
      });
    });
  </script>
@endsection

{{-- <div class="col-md-12">                        
    <button type="button" class="btn btn-primary">Nuevo</button>                             
    <div class="card card-secondary">
        <div class="card-header">
          <h3 class="card-title">Listado</h3>              
        </div>
        <!-- /.card-header -->
        <div class="card-body">
        </div>
        {{-- <div class="card-footer">
            <button type="submit" class="btn btn-primary">Submit</button>
        </div>     --}}
    {{-- </div>     
</div> --}}