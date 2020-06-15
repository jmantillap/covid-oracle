@extends('layout')
@section('title','Formulario COVID-19' )
@section('titulopag','VERIFICANDO DOCUMENTO')
@section('elcontrolador','Revisión')
@section('laaccion','Verificación')



@section('content')


<?php 

//dd($contestohoy);
if ($errorenform=="Usuario No Existe")
  {
  ?>
  <h4>Usuario no Registrado. Por favor haga su proceso de Registro</h4><br>
  <a href="{{ route('users.create') }}" class="btn btn-warning">Registrarse</a>
  <?php
  }
else 
  {
  ?>   
  <h4>Bienvenido   <strong>{{$nombrecompleto}} <p class="text-danger">{{$usuarioesta->c_codtipo}}: {{$usuarioesta->t_documento}}</p></strong> </h4><br>

  <h3>Encuesta para identificar posibles casos de COVID-19 en UPB</h3>
  <?php
  if ($contestohoy=="SI") echo '<h4>El d&iacute;a de Hoy ya contest&oacute; el formulario. Muchas gracias</h4><br>';
    else
    {
    ?>
    


    <?php 
    }
    ?>

   

<?php
}



?>


 
@endsection


