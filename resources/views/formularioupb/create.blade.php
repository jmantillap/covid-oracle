@extends('layout')

@section('title','Formulario de COVID-19')
@section('titulopag','Formulario COVID')
@section('elcontrolador','Formulario Usuario UPB')
@section('laaccion','Llenar todos los campos')
    



@section('content')
@include('partials.session-status')
@include('partials.validation-errors')



<form action="{{ route('formularioupb.store')}}" method="POST">
        @include('formularioupb._form',['btnText'=>'Guardar'])
</form>
<script>
$('input[type=radio][name=t_irahoy]').change(function() {
        if (this.value == 'SI') {
                $("#t_sitios").show();
                $("#lt_sitios").show();
                $("#t_actividades").show();
                $("#lt_actividades").show();

        }
        else if (this.value == 'NO') {
                $("#t_sitios").hide();
                $("#lt_sitios").hide();
                $("#t_actividades").hide();
                $("#lt_actividades").hide();

        }
    });
</script>
<script>
$('input[type=radio][name=t_presentadofiebre]').change(function() {
        if (this.value == 'SI') {
                $("#t_diasfiebre").show();
                $("#lt_diasfiebre").show();
               

        }
        else if (this.value == 'NO') {
                $("#t_diasfiebre").hide();
                $("#lt_diasfiebre").hide();
                
        }
    });  
</script>

<script>
        $('input[type=radio][name=t_contactopersonasinfectadas]').change(function() {
                if (this.value == 'SI') {
                        $("#d_ultimocontacto").show();
                        $("#ld_ultimocontacto").show();
                       
        
                }
                else if (this.value == 'NO') {
                        $("#d_ultimocontacto").hide();
                        $("#ld_ultimocontacto").hide();
                        
                }
            });  
</script>
    
<script>
        $('input[type=radio][name=t_realizoviaje]').change(function() {
                if (this.value == 'SI') {
                        $("#d_ultimoviaje").show();
                        $("#ld_ultimoviaje").show();
                       
        
                }
                else if (this.value == 'NO') {
                        $("#d_ultimoviaje").hide();
                        $("#ld_ultimoviaje").hide();
                        
                }
            });  
</script>

@endsection