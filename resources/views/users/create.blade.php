@extends('layout')

@section('title','Registro de usuario')
@section('titulopag','Registro COVID-19')
@section('elcontrolador','Registro de usuario')
@section('laaccion','Formulario de Registro')
    



@section('content')
@include('partials.session-status')
@include('partials.validation-errors')

<form action="{{ route('users.store')}}" method="POST">
        @include('users._form',['btnText'=>'Guardar'])
</form>

    
@endsection
 
@section('script-custom')
<script>
    $(function () {      
      $("#menuUsuario" ).addClass("active" );
     });
  </script>
  <script>
        $(document).ready(function() {
            $("#t_jefeinmediatocontacto_d").hide();
            $("#t_jefeinmediatocontacto").prop('required', false).hide();
            $("#t_facultadareaempresa_d").hide(); 
            $("#t_facultadareaempresa").prop('required', false).hide();  
 
            $('#n_idvinculou').change(function() {
                var vselected = $('#n_idvinculou option:selected').text();
                if (vselected == 'Visitante' || vselected == 'Egresado' || vselected == 'Proveedor' || vselected == 'Estudiante'|| this.value=='') 
                {
                  $("#t_jefeinmediatocontacto_d").hide();
                  $("#t_jefeinmediatocontacto").prop('required', false).hide().val('');
                  $("#t_facultadareaempresa_d").hide(); 
                  $("#t_facultadareaempresa").prop('required', false).hide().val('');  
                }
            else
                {
                  $("#t_jefeinmediatocontacto_d").show();
                  $("#t_jefeinmediatocontacto").prop('required', true).show();
                  $("#t_facultadareaempresa_d").show();  
                  $("#t_facultadareaempresa").prop('required', true).show();
                }
            });  
            $('#n_idciudad').change(function() {
                $('#n_idsede').empty().append('<option value="" selected>--Seleccionar sede--</option>');            
                if(this.value==""){return;}
                $.get('create/' + this.value, function(data) {
		              $.each(data,function(key, value) {
			              $("#n_idsede").append('<option value='+value.n_idsede+'>'+value.t_sede+'</option>');
                  });
	              });
            });
        });
</script>
@endsection
