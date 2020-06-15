
@extends('layout')
@section('title','Formulario COVID-19' )
@section('titulopag','ACTUALIZAR CONSTRASEÑA')
@section('elcontrolador','Menu')
@section('laaccion','Perfil')
@section('content')
@include('partials.validation-errors')
{{-- /**
 * Javier Mantilla. javier.mantillap@upb.edu.co
 * 2020-06
 */ --}}
<form role="form" id="frmPerfil" method="post" action="{{ route('perfil.guardar') }}"  >
                {{ csrf_field() }}
<div class="col-md-6">
    <div class="card card-secondary">
        <div class="card-header">
            <h3 class="card-title">Datos Perfil</h3>               
        </div>    
        <div class="card-body">
            <div class="form-group">
                <label type="text" class="form-control">{{ auth()->user()->t_nombrecompleto }}</label>
            </div>
            <div class="form-group" >
                <label for="email-d">Login</label>
                <input  class="form-control" name="login-d" id="login-d" value="{{auth()->user()->t_login}}" disabled />
                <input type="hidden"  value="{{auth()->user()->t_login}}"  class="form-control" name="t_login" id="t_login" />
            </div>
            <div class="card-header">
                <h3 class="card-title">Cambiar Contraseña</h3>
            </div>
            <div class="form-group">
                <label for="actual_password">Actual Pasword</label>
                <input type="password" id="actual_password" name="actual_password" class="form-control @error('actual_password') is-invalid @enderror" 
                placeholder="Digite el Password" value="{{ old('actual_password')}}" required>                
            </div>
            <div class="form-group">
                <label for="password">Nuevo Pasword</label>
                <input type="password" id="password" name="password" class="form-control @error('actual_password') is-invalid @enderror" 
                placeholder="Digite el nuevo Password" required>                
            </div>
            <div class="form-group">
                <label for="password_confirmation">Confirmar nuevo Password</label>
                <input type="password" id="password_confirmation" name="password_confirmation" class="form-control" placeholder="Confirmar password" required>                
            </div>
        </div>     
        <div class="card-footer">            
            <a href="{{ route('home') }}" class="btn btn btn-secondary" role="button">Volver</a>
            <button type="submit" class="btn btn-info pull-right">Actualizar</button>
        </div>   
    </div>    
</div>
</form>
@endsection
@section('script-custom')
<script>
    $(function () {      
      $("#menuPerfil" ).addClass("active" );                  
      //$("#n_idciudad" ).addClass("is-invalid" );                  
      
    });
  </script>
@endsection
