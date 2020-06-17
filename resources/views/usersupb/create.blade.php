@extends('layout')

@section('title','Registro de usuario')
@section('titulopag','Registro COVID-19')
@section('elcontrolador','Registro de usuario')
@section('laaccion','Formulario de Registro')
    



@section('content')
@include('partials.session-status')
@include('partials.validation-errors')

<form action="{{ route('usersupb.store')}}" method="POST">
        @include('usersupb._form',['btnText'=>'Guardar'])
</form>

    
@endsection

@section('script-custom')
<script>
    $(function () {      
      $("#menuUsuario" ).addClass("active" );
     });
  </script>
@endsection