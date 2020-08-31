@extends('layout')

@section('title','Formulario de COVID-19')
@section('titulopag','Formulario COVID')
@section('elcontrolador','Formulario Usuario UPB')
@section('laaccion','Todos los campos son obligatorios.')
    


 
@section('content')
@include('partials.session-status')
@include('partials.validation-errors')



<form action="{{ route('formularioupb.store')}}" method="POST" id="formularioupb" >
        @include('formularioupb._form',['btnText'=>'Guardar'])
</form>
<script>
        $(document).ready(function() {
                $("#formularioupb")[0].reset();
                $("#n_idciudad").val('');
                $('input[type=radio][name=t_irahoy]').prop("checked",false);

                //Ciudades
                $('#n_idciudad').change(function() {
                        $('#n_idsede').empty().append('<option value="" selected>--Seleccionar sede--</option>');            
                        if(this.value==""){return;}
                        $.get('create/' + this.value, function(data) {
                                $.each(data,function(key, value) {
                                        $("#n_idsede").append('<option value='+value.n_idsede+'>'+value.t_sede+'</option>');
                                });
                        });
                });

                //ir_hoy
                $('input[type=radio][name=t_irahoy]').change(function() {
                        if (this.value == 'SI') {
                                $("#t_sitios").prop('required', true).show();
                                $("#lt_sitios").show();
                                $("#t_actividades").prop('required', true).show();
                                $("#lt_actividades").show();
                        }
                        else{
                                $("#t_sitios").prop('required', false).hide().val(''); 
                                $("#lt_sitios").hide();
                                $("#t_actividades").prop('required', false).hide().val('');
                                $("#lt_actividades").hide();
                        }
                });

                //fiebre
                $('input[type=radio][name=t_presentadofiebre]').change(function() {
                        if (this.value == 'SI') {
                                $("#t_diasfiebre").prop('required', true).show();
                                $("#lt_diasfiebre").show();
                        }
                        else{
                                $("#t_diasfiebre").prop('required', false).hide().val('');
                                $("#lt_diasfiebre").hide();
                        }
                });  

                //personalsalud
                $('input[type=radio][name=t_personalsalud]').change(function() {
                        if (this.value == 'NO') {
                                $("#t_contactopersonasinfectadas").prop('required', true).show();
                                $("#lt_contactopersonasinfectadas").show();
                        }
                        else{
                                $("#t_contactopersonasinfectadas").prop('required', false).hide().val('');
                                $("#lt_contactopersonasinfectadas").hide();
                                $("#d_ultimocontacto").prop('required', false).hide().val('');
                                $("#ld_ultimocontacto").hide();
                        }
                });

                //contactoinfectado
                $('input[type=radio][name=t_contactopersonasinfectadas]').change(function() {
                        if (this.value == 'SI') {
                                $("#d_ultimocontacto").prop('required', true).show();
                                $("#ld_ultimocontacto").show();
                        }
                        else{
                                $("#d_ultimocontacto").prop('required', false).hide().val('');
                                $("#ld_ultimocontacto").hide();
                        }
                });  

                //realizoviaje
                $('input[type=radio][name=t_realizoviaje]').change(function() {
                        if (this.value == 'SI') {
                                $("#d_ultimoviaje").prop('required', true).show();
                                $("#ld_ultimoviaje").show();
                        }
                        else{
                                $("#d_ultimoviaje").prop('required', false).hide().val('');
                                $("#ld_ultimoviaje").hide();
                        }
                });  
        });
</script>
@endsection