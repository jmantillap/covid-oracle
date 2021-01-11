@extends('layout')
@section('title','Acta de COVID-19')
@section('titulopag',Session::has('userUPB') ? 'COMUNIDAD UPB' : 'VISITANTES' )
@section('elcontrolador','Formulario Usuario UPB')
@section('laaccion','ACTA DE COMPROMISO COVID-19.')
@section('content')
@include('partials.validation-errors')
<form action="{{ route('acta.usuario.guardar')}}" method="POST" id="formularioActa" name="formularioActa" class="formulario" role="form" >
@csrf    
<div class="col-md-12">
    <div class="card card-info">
        <div class="card-header">
            <h3 class="card-title">Consentimiento: <strong>{{$user->c_codtipo}}. {{$user->t_documento}} - {{$user->t_nombres}} {{$user->t_apellidos}}</strong></h3>
        </div>
        <div class="card-body">
            @if (Session::has('userUPB') && Session::get('userUPB')->n_idusuario!=null)
                {!! strip_tags(str_replace('$viculoconu','xxxxxxxxx',Config::get('actacovid.comunidad')),'<strong><br>') !!}    
            @else
                {!! strip_tags(str_replace('$viculoconu','xxxxxxxxx',Config::get('actacovid.visitante')),'<strong><br>') !!}    
            @endif            
            <br><br>
            <label>
                Acepto
            </label>
            <br>
            <input   type="radio" name="t_consentimiento" value="SI"  {{(old('t_consentimiento') == 'SI') ? 'checked' : ''}} required> SI &nbsp;&nbsp;&nbsp;
            <input   type="radio" name="t_consentimiento" value="NO" {{(old('t_consentimiento') == 'NO') ? 'checked' : ''}} > NO<br>
        </div>
    </div>
</div>
<div class="form-group row">
    <div class="col-md-5">
    <button type="submit" class="btn btn-info">Guardar</button>
    </div>
</div>
</form>
@endsection
@include('partials.session-status')
@section('script-custom')
<script>         
    $(function () {
        

    });
</script>
@endsection