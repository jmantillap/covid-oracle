@extends('layout')
@section('title','Formulario COVID-19' )
@section('titulopag','PÁGINA DE CONSULTA')
@section('elcontrolador','Principal')
@section('laaccion','Formulario de Consulta')
<?php
if (Auth::check())
    
    $nombrecompleto= Auth::user()->t_nombres.' '.Auth::user()->t_apellidos;
else {
    $nombrecompleto="Invitado";
    }
?>

@section('nombusuario', $nombrecompleto )

@section('content')
@include('partials.session-status')

<h4><strong>Puede Consultar su resultado previo de la encuesta del día de hoy con su documento</h4><br>

<h4><p class="text-danger">Documento</p></h4>
 {{-- @guest --}}

 <form action="{{ route('consultar')}}" method="POST">
    @include('consulta._form',['btnText'=>'Consultar'])
</form>

<br><br>

{{-- @endguest --}}
@endsection
@section('script-cumstom')
<script>
    $(function () {      
      $("#menuHome" ).addClass("active" );            
      
    });
  </script>
@endsection
