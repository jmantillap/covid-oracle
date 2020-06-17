@extends('layout')

@section('title','Mostrar usuario ' )
@section('titulopag','USUARIOS')
@section('elcontrolador','USUARIOS')
@section('laaccion','Usuario seleccionado')
    



@section('content')
@auth

@include('partials.session-status')

<div class="post">
    <div class="user-block">
        <img class="img-circle img-bordered-sm" src="/dist/img/usuario.jpg" alt="user image">
      <span class="username">
        <a href="#">{{$users->t_nombres}} {{$users->t_apellidos}}</a>
        @auth
               <a href="{{ route('users.edit',$users)}}" class="btn btn-app-xs"><i class="fas fa-edit"></i> Editar</a>
               <a href="{{ route('users.index')}}" class="btn btn-app-xs"><i class="fas fa-backward"></i> Volver al Listado</a>
        @endauth
        
              </span>

      <!--<span class="description">Nombre Escuela - {{$users->t_sede}}</span>-->
     
    </div>
    <!-- /.user-block -->
    <p>
      <strong>Documento</strong> - 
      {{$users->c_codtipo}}: {{$users->t_documento}}
    </p>

    <p>
      <strong>Sede</strong> - 
      {{$users->sede->t_sede}}
    </p>

    <p>
      <strong>ID SIGAA</strong> - 
      {{$users->t_idsigaa}}
    </p>

    <p>
      <strong>E-mail</strong> - 
      {{$users->t_email}}
    </p>

    <p>
      <strong>Teléfono o Celular</strong> - 
      {{$users->t_telefono}}
    </p>

    <p>
      <strong>Jefe Inmediato o Contacto</strong> - 
      {{$users->t_jefeinmediatocontacto}}
    </p>

    <p>
      <strong>Facultad, Departmento o Empresa</strong> - 
      {{$users->t_facultadareaempresa}}
    </p>

    <p>
      <strong>Vínculo con la UPB</strong> - 
      {{$users->vinculou->t_vinculo}}
    </p>

    <p>
      <strong>Activo</strong> - 
      {{$users->t_activo}}
    </p>
  

    
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


