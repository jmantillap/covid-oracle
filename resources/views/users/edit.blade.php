@extends('layout')

@section('title','Edición de Usuario')
@section('titulopag','EDITAR USUARIO')
@section('elcontrolador','USUARIOS')
@section('laaccion','Edición')
    



@section('content')
@auth
@include('partials.session-status')
@include('partials.validation-errors')

<form action="{{ route('users.update',$users) }}" method="POST">
    @method('PATCH')
    @include('users._form',['btnText'=>'Actualizar'])
</form>

@endauth    
@endsection


@section('script-custom')
<script>
    $(function () {      
      $("#menuUsuario" ).addClass("active" );
     });
  </script>
@endsection