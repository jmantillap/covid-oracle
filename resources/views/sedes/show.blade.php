@extends('layout')

@section('title','Administración | ' . $sedes->t_sede)
@section('titulopag','SEDES')
@section('elcontrolador','SEDES')
@section('laaccion','Sede seleccionada')
    



@section('content')


@include('partials.session-status')


<div class="post">
    <div class="user-block">
        <img class="img-circle img-bordered-sm" src="/dist/img/sede.jpg" alt="user image">
      <span class="username">
        <a href="#">{{$sedes->t_sede}}</a>
        @auth
               <a href="{{ route('sedes.edit',$sedes)}}" class="btn btn-app-xs"><i class="fas fa-edit"></i> Editar</a>
               <a href="{{ route('sedes.index')}}" class="btn btn-app-xs"><i class="fas fa-backward"></i> Volver al Listado</a>
        @endauth
              </span>

      <!--<span class="description">Nombre Escuela - {{$sedes->t_sede}}</span>-->
     
    </div>
    <!-- /.user-block -->
    
    <p>
        <strong>Ciudad a la que pertenece la Sede</strong> - 
        {{$sedes->ciudad->t_nombre}}
    </p>
   
    @auth
  <form action="{{ route('sedes.destroy', $sedes) }}" method="POST">
  @csrf
  @method('DELETE')
  <button type="submit" class="btn btn-xs btn-danger" onclick="return confirm('Confirma que desea eliminar el Registro?')"><span class="fa fa-times"></span>&nbsp;Eliminar Item Seleccionado</button>

</form>


@endauth



  

    

    
  </div>


  


@endsection

@section('script-custom')
<script>
    $(function () {      
      $("#menuSedes" ).addClass("active" );
     });
  </script>
@endsection