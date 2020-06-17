


@extends('layout')

@section('title','Formulari COVID-19')
@section('titulopag','Formulario')
@section('elcontrolador','Formulario')
@section('laaccion','Perfil Verificado')
    



@section('content')

@include('partials.session-status')







<a href="{{ route('formulario.create') }}" class="btn  btn-danger btn-xs">Crear Sede</a><br>

@endsection

