@extends('layout')

@section('title','Creación de Sede')
@section('titulopag','SEDES')
@section('elcontrolador','SEDES')
@section('laaccion','Creación')
    



@section('content')
@include('partials.session-status')
@include('partials.validation-errors')

<form action="{{ route('sedes.store')}}" method="POST">
        @include('sedes._form',['btnText'=>'Guardar'])
</form>

    
@endsection

@section('script-custom')
<script>
    $(function () {      
      $("#menuSedes" ).addClass("active" );
     });
  </script>
@endsection