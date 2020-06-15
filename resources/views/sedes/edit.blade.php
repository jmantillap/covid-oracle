@extends('layout')

@section('title','Edición de Sede')
@section('titulopag','SEDE')
@section('elcontrolador','SEDE')
@section('laaccion','Edición')
    



@section('content')
@include('partials.session-status')
@include('partials.validation-errors')




<form action="{{ route('sedes.update',$sedes) }}" method="POST">
    @method('PATCH')
    @include('sedes._form',['btnText'=>'Actualizar'])
</form>

    
@endsection

@section('script-custom')
<script>
    $(function () {      
      $("#menuSedes" ).addClass("active" );
     });
  </script>
@endsection