@extends('layout')
@section('title','Formulario COVID-19' )
@section('titulopag','LISTADO DE ADMINISTRADORES')
@section('elcontrolador','Menu')
@section('laaccion','Administradores')
@section('content')
{{-- /**
 * Javier Mantilla. javier.mantillap@upb.edu.co
 * 2020-06
 */ --}}
<div class="row">
    <div class="col-xs-12">
        <form action="{{ route('administrador.listar.nuevo') }}" method="get">
            <button type="submit" class="btn btn-info pull-left">Nuevo</button>
        </form>
    </div>    
</div>    
<div class="table-responsive">
    <table id="example1" class="table table-bordered table-striped tbl">
        <thead>
            <tr>
                <th class="text-center">Sel..</th>
                <th>ID</th><th>Nombre</th><th>login</th>
                <th>Ldap</th>
                <th>Ciudad</th>
                <th>Todas</th>
                <th>Bienestar</th>
                <th>Email</th>
                <th>Actualización</th>
                <th class="text-center">Estado</th>
            </tr>
        </thead>
        <tbody>
            @foreach($administradores as $adm)
                <tr>
                    <td class="text-center">
                        <form method="POST" action="{{ route('administrador.seleccionar') }}">
                            <input type="hidden" name="idAdministradorSeleccionado" value="{{ $adm->n_id }}">
                            {!! csrf_field() !!}
                            <button type="submit" class="btn btn-primary">
                                <span class="fas fa-edit"></span>
                            </button>
                        </form>
                    </td>
                    <td>{{ $adm->n_id }}</td>
                    <td>{{ $adm->t_nombrecompleto }}</td>
                    <td>{{ $adm->t_login }}</td>                    
                    <td class="text-center">
                        @if ($adm->b_ldap == 1)
                            <span class="badge badge-success">Si</span>
                        @endif
                    </td>
                    <td>{{ $adm->ciudad->t_nombre ?? '' }}</td>
                    <td class="text-center">
                        @if ($adm->b_todas == 1)
                            <span class="badge badge-success">Si</span>
                        @else{{-- <span class="badge badge-danger">No</span> --}}
                        @endif
                    </td>
                    <td class="text-center">
                        @if ($adm->b_estudiantes == 1)
                            <span class="badge badge-success">Si</span>                        
                        @endif
                    </td>
                    <td>{{ $adm->t_email }}</td>
                    <td>{{ $adm->dt_updated_at }}</td>
                    <td class="text-center">
                        @if ($adm->b_habilitado == 1)
                            <span class="badge badge-success">Activo</span>
                        @else
                            <span class="badge badge-danger">Inactivo</span>
                        @endif
                    </td>
                </tr>
            @endforeach
        </tbody>
        <tfoot>
            {{-- <tr><th>ID</th><th>Nombre</th><th>Apellidos</th><th>Email</th>
                <th>Actualización</th><th>Estado</th><th class="text-center">Seleccionar</th></tr> --}}
        </tfoot>
    </table>
</div>

@endsection
@section('script-custom')
<script>
    $(function () {      
      $("#menuAdministrador" ).addClass("active" );
      //$("#menuHome" ).removeClass("active" );
      
      $('#example1').DataTable({
        "paging": true,"lengthChange": false,"searching": true,
        "ordering": false,"info": true,"autoWidth": false,
        "responsive": true,"language": { "url": "/plugins/datatables/locale/Spanish.json",},
        "pageLength": 10,"lengthMenu": [[10, 25, 50,100, -1], [10, 25, 50,100, "All"]],
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