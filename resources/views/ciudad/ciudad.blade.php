@extends('layout')
@section('title','Formulario COVID-19' )
@section('titulopag','CIUDADES')
@section('elcontrolador','Menu')
@section('laaccion','Ciudades')
@section('content')
@include('partials.validation-errors')
{{-- /**
 * Javier Mantilla. javier.mantillap@upb.edu.co
 * 2020-06
 */ --}}
<div class="col-md-6">
    <form class="formulario1" role="form" id="frmCiudad"  method="post" action="{{ route('ciudad.guardar') }}"    >    
        {{ csrf_field() }}
    <div class="card card-secondary">
        <div class="card-header">
            <h3 class="card-title">Datos Básicos</h3>   
            <label>&nbsp&nbsp&nbsp&nbsp&nbsp&nbspID:</label>&nbsp&nbsp<label class="btn bg-yellow">{{$ciudad->n_id}}</label>
            <input id="n_id" name="n_id" type="hidden" value="{{$ciudad->n_id}}" />           
        </div>    
        <div class="card-body">
            <div class="form-group">
                <label for="t_nombre">Nombre*</label>
                <input type="text" class="form-control @error('t_nombre') is-invalid @enderror" id="t_nombre" name="t_nombre" placeholder="Digite el nombre completo"
                value="{{ $ciudad->t_nombre }}" required>
            </div>                                    
            <div class="form-group ">
                <label for="b_habilitado">Estado</label>
                <input name="b_habilitado" id="b_habilitado" type="checkbox" {{ $ciudad->b_habilitado==1 ? 'checked' : '' }} value="1" class="flat-red" > Activo
            </div>
            @if ($ciudad->n_id!=null)
            <div class="form-group ">
                <p>Ultima actualización : {{ $ciudad->dt_update_at}}</p>
            </div>   
            @endif
        </div>
        <div class="card-footer">
            <a href="{{ route('ciudad.listar') }}" class="btn btn btn-secondary" role="button">Volver</a>
            <button type="submit" class="btn btn-primary pull-right">Guardar</button>
        </div>      
    </div> 
    </form>
</div>
@endsection
@section('script-custom')
<script>
    $(function () {      
        $("#menuCiudad" ).addClass("active" );
        $("#menuTablas" ).addClass("menu-open" );
      
    });
  </script>
@endsection
