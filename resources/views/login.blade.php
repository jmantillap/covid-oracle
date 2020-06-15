@extends('layout')
@section('title','Formulario COVID-19' )
@section('titulopag','PÁGINA PRINCIPAL')
@section('elcontrolador','Principal')
@section('laaccion','Formulario')
<?php
if (Auth::check())
    
    $nombrecompleto= Auth::user()->t_nombres.' '.Auth::user()->t_apellidos;
else {
    $nombrecompleto="Invitado";
    }
?>

@section('nombusuario', $nombrecompleto )
@include('partials.session-status')

@section('content')



<h4>Bienvenido a la página inicial del Aplicativo de Control de Ingreso UPB</h4><br>

<h4><p class="text-danger">Documento</p></h4>
 @guest

 <form action="{{ route('revisar')}}" method="POST">
    @include('revisar._form',['btnText'=>'Guardar'])
</form>

<br><br>





@endguest
@endsection
