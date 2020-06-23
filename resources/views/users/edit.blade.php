@extends('layout')

@section('title','Edición de Usuario')
@section('titulopag','EDITAR USUARIO')
@section('elcontrolador','USUARIOS')
@section('laaccion','Edición')
    



@section('content')
@auth
@include('partials.session-status')
@include('partials.validation-errors')

<form action="{{ route('users.update',$users) }}" method="POST">
    @method('PATCH')
    @include('users._form',['btnText'=>'Actualizar'])
</form>

@endauth    
@endsection


@section('script-custom')
<script>
    $(function () {      
        $("#menuUsuario" ).addClass("active" );
        $('#n_idciudad').change(function() {
              $('#n_idsede').empty().append('<option value="" selected>--Seleccionar sede--</option>');            
              if(this.value==""){return;}
              $.get('/users/create/' + this.value, function(data) {
                $.each(data,function(key, value) {
                  $("#n_idsede").append('<option value='+value.n_idsede+'>'+value.t_sede+'</option>');
                });
                @if ($users->sede!=null)
                  $("#n_idsede").val({{ $users->sede->n_idsede }});
                @endif            

              });
        });        
        @if ($users->sede!=null && $users->sede->ciudad!=null ) 
          //console.log('tiene Sesde y ciudad');
          $('#n_idciudad').val({{ $users->sede->ciudad->n_id  }})
          $("#n_idciudad").trigger('change');
          //setTimeout(function(){ 
            //console.log('Coloco la sede')  
            //$("#n_idsede").val({{ $users->sede->n_idsede }});
          //}, 5000);          
        @endif
     });     
     
  </script>
@endsection