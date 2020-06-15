@extends('layout')


@section('title','Registrar Usuario')
@section('titulopag','REGISTRO')
@section('elcontrolador','REGISTRO')
@section('laaccion','Registro de Usuario')
    



@section('content')
@include('partials.session-status')
@include('partials.validation-errors')

<script>
$(document).ready(function(){
    $("#t_emailc").on('paste', function(e){
      e.preventDefault();
      alert('Esta acción está prohibida');
    })
    
    $("#t_emailc").on('copy', function(e){
      e.preventDefault();
      alert('Esta acción está prohibida');
    })
  })

</script>


<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header"><h3>Datos Obligatorios </h3>
                    @if ($errors->any())
                    <ul>
                     @foreach ($errors->all() as $item)
                 
                     <li>{{ $item }}</li>
                         
                     @endforeach
                 </ul> 
                 @endif
                
                </div>
<!-- , n_idusuario, n_idsede, t_apellidos, t_nombres, c_codtipo, t_documento, t_idsigaa, t_email, t_telefono, t_jefeinmediatocontacto, t_facultadareaempresa, n_idvinculou, password, t_activo, created_at, updated_at
-->
                <div class="card-body">
                    <form method="POST" action="{{ route('register') }}">
                        @csrf

                        <div class="form-group row">
                            <label for="t_apellidos" class="col-md-4 col-form-label text-md-right">{{ __('Apellidos') }}</label>

                            <div class="col-md-6">
                                <input id="t_apellidos" type="text" class="form-control @error('t_apellidos') is-invalid @enderror" name="t_apellidos" value="{{ old('t_apellidos') }}" required autocomplete="apellidos" autofocus>

                                @error('t_apellidos')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="t_nombres" class="col-md-4 col-form-label text-md-right">{{ __('Nombres') }}</label>

                            <div class="col-md-6">
                                <input id="t_nombres" type="text" class="form-control @error('t_nombres') is-invalid @enderror" name="t_nombres" value="{{ old('t_nombres') }}" required autocomplete="nombres" >

                                @error('t_nombres')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="c_codtipo" class="col-md-4 col-form-label text-md-right">{{ __('Codigo Documento') }}</label>

                            <div class="col-md-6">
                                <select name="c_codtipo" class="form-control" id="c_codtipo" required>
                                    <option value="" >--Seleccionar Cod.--</option>
                                    <option value="TI" value="M" @if (old('c_codtipo') == "TI") {{ 'selected' }} @endif>Tarjeta de Identidad</option> 
                                    <option value="CC" @if (old('c_codtipo') == "CC") {{ 'selected' }} @endif>Cédula de Ciudadanía</option>
                                    <option value="CE" @if (old('c_codtipo') == "CE") {{ 'selected' }} @endif>Cédula de Extranjería</option>
                                    <option value="PA" @if (old('c_codtipo') == "PA") {{ 'selected' }} @endif>Pasaporte</option>
                                </select>
                                @error('c_codtipo')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>                  




                        <div class="form-group row">
                            <label for="t_documento" class="col-md-4 col-form-label text-md-right">{{ __('Documento') }}</label>

                            <div class="col-md-6">
                                <input placeholder="Solo numeros, no use puntos ni guiones" id="t_documento" type="number" class="form-control @error('t_documento') is-invalid @enderror" name="t_documento" value="{{ old('t_documento') }}" required autocomplete="documento" >

                                @error('t_nombres')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="t_idsigaa" class="col-md-4 col-form-label text-md-right">{{ __('IDSIGAA') }}</label>

                            <div class="col-md-6">
                                <input id="t_idsigaa" type="text" class="form-control @error('t_idsigaa') is-invalid @enderror" name="t_idsigaa" value="{{ old('t_idsigaa') }}"  >

                                @error('t_idsigaa')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="t_email" class="col-md-4 col-form-label text-md-right">{{ __('E-Mail') }}</label>

                            <div class="col-md-6">
                                <input id="t_email" type="email" class="form-control @error('t_email') is-invalid @enderror" name="t_email" value="{{ old('t_email') }}" required >

                                @error('t_email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="t_emailc" class="col-md-4 col-form-label text-md-right">{{ __('E-Mail Confirmación') }}</label>

                            <div class="col-md-6">
                                <input id="t_emailc" type="email" class="form-control @error('t_emailc') is-invalid @enderror" name="t_emailc" value="{{ old('t_emailc') }}" required >

                                @error('t_emailc')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                                                

                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Registrarse') }}
                                </button>
                                <a href="{{ route('home') }}" class="btn btn-warning">Volver</a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
