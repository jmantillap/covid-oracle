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
            $("#t_facultadareaempresa_d").hide(); 
            $("#t_jefeinmediatocontacto").hide();
            $("#t_facultadareaempresa").hide();  
 
            $('#n_idvinculou').change(function() {
                var vselected = $('#n_idvinculou option:selected').text();
                if (vselected == 'Visitante' || vselected == 'Egresado' || vselected == 'Proveedor' || vselected == 'Estudiante'|| this.value=='') 
                {
                  $("#t_jefeinmediatocontacto_d").hide();
                  $("#t_facultadareaempresa_d").hide(); 

                  $("#t_jefeinmediatocontacto").hide();
                  $("#t_facultadareaempresa").hide();  
                }
                
                else
                {
                  $("#t_jefeinmediatocontacto_d").show();
                  $("#t_facultadareaempresa_d").show();  

                  $("#t_jefeinmediatocontacto").show();
                  $("#t_facultadareaempresa").show();     
                }
            });  
        });
</script>
@endsection
