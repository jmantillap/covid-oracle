@extends('layout')
@section('title','Formulario COVID-19' )
@section('titulopag','USUARIOS ADMINISTRADORES')
@section('elcontrolador','Menu')
@section('laaccion','Administradores')
@section('content')
@include('partials.validation-errors')
{{-- /**
 * Javier Mantilla. javier.mantillap@upb.edu.co
 * 2020-06
 */ --}}
<div class="col-md-6">
    <form class="formulario1" role="form" id="frmAdministrador"  method="post" action="{{ route('administrador.guardar') }}"    >    
        {{ csrf_field() }}
    <div class="card card-secondary">
        <div class="card-header">
            <h3 class="card-title">Datos Básicos</h3>   
            <label>&nbsp&nbsp&nbsp&nbsp&nbsp&nbspID:</label>&nbsp&nbsp<label class="btn bg-yellow">{{$administrador->n_id}}</label>
            <input id="n_id" name="n_id" type="hidden" value="{{$administrador->n_id}}" />           
        </div>    
        <div class="card-body">
            <div class="form-group">                
                <label for="t_login" class="control-label">Login *</label>           
                <div class="row">
                   <div class="col-5">
                        @if ($administrador->n_id!=null)
                        <input type="text" class="form-control @error('t_login') is-invalid @enderror" maxlength="20" id="t_login_d" name="t_login_d" value="{{ $administrador->t_login }}" disabled>
                        <input type="hidden" id="t_login" name="t_login"  value="{{ $administrador->t_login }}">    
                        @else
                        <input type="text" class="form-control @error('t_login') is-invalid @enderror" maxlength="20" id="t_login" name="t_login"  placeholder="Usuario o Id Sigaa" value="{{ $administrador->t_login }}" required>    
                        @endif
                   </div>
                </div>
            </div>
            <div class="form-group">
                <label for="t_nombrecompleto">Nombre Completo *</label>
                <input type="text" class="form-control @error('t_nombrecompleto') is-invalid @enderror" id="t_nombrecompleto" name="t_nombrecompleto" placeholder="Digite el nombre completo"
                value="{{ $administrador->t_nombrecompleto }}" required>
            </div>
            <div id="prueba" class="form-group">
                <label for="email-d">Email</label>
                @if ($administrador->n_id!=null)
                    <input type="email"  class="form-control @error('t_email') is-invalid @enderror" name="email-d" id="email-d" value="{{$administrador->t_email}}" disabled />
                    <input type="hidden"  value="{{$administrador->t_email}}"  class="form-control" name="t_email" id="t_email" />
                @else
                    <input type="email"  class="form-control  @error('t_email') is-invalid @enderror " name="t_email" id="t_email" 
                    placeholder="Ingrese Correo electronico"
                    value="{{$administrador->t_email}}"  required>
                @endif                            
            </div>
            <div class="form-group"  id="grupoInstrumento" >
                <label for="n_idciudad" class="control-label">Ciudad *</label>                
                <div class="row">
                    <div class="col-7">
                        <select class="form-control @error('n_idciudad') is-invalid @enderror " name="n_idciudad" id="n_idciudad" required>
                            <option value="">Seleccione ...</option>
                            @foreach($listaCiudades as $ciudad)
                                <option value="{{$ciudad->n_id}}"{{ ($administrador->n_idciudad==$ciudad->n_id) ? 'selected=selected' : '' }}>
                                 {{$ciudad->t_nombre}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
            </div>
            <div class="form-group ">
                <label for="b_todas">Nacional</label>
                <input name="b_todas" id="b_todas" type="checkbox" {{ $administrador->b_todas==1 ? 'checked' : '' }} value="1" class="flat-red" > Todas Ciudades
            </div>
            <div class="form-group ">
                <label for="b_estudiantes">Estudiantes</label>
                <input name="b_estudiantes" id="b_estudiantes" type="checkbox" {{ $administrador->b_estudiantes==1 ? 'checked' : '' }} value="1" class="flat-red" > Bienestar Universitario
            </div>            
            <div class="form-group">
                <label for="password">Pasword</label>
                <div class="input-group mb-3">
                    <input type="password" id="password" name="password" class="form-control @error('password') is-invalid @enderror" placeholder="Digite el Password">
                    <div class="input-group-append">
                      <span class="input-group-text"><i class="fas fa-lock"></i></span>
                    </div>
                </div>    
            </div>
            <div class="form-group has-feedback">
                <label for="password_confirmation">Confirmar Password</label>
                <div class="input-group mb-3">
                    <input type="password" id="password_confirmation" name="password_confirmation" 
                    class="form-control @error('password_confirmation') is-invalid @enderror" placeholder="Confirmar password">
                    <div class="input-group-append">
                      <span class="input-group-text"><i class="fa fa-sign-in-alt"></i></span>
                    </div>
                </div>                  
            </div>              
            <div class="form-group ">
                <label for="b_ldap">Ldap</label>
                <input name="b_ldap" id="b_ldap" type="checkbox" {{ $administrador->b_ldap==1 ? 'checked' : '' }} value="1" class="flat-red" > Web Services
            </div>
            <div class="form-group ">
                <label for="b_habilitado">Estado</label>
                <input name="b_habilitado" id="b_habilitado" type="checkbox" {{ $administrador->b_habilitado==1 ? 'checked' : '' }} value="1" class="flat-red" > Activo
            </div>
            @if ($administrador->n_id!=null)
            <div class="form-group ">
                <p>Ultima actualización : {{ $administrador->dt_updated_at}}</p>
            </div>   
            @endif
        </div>
        <div class="card-footer">
            <a href="{{ route('administrador.listar') }}" class="btn btn btn-secondary" role="button">Volver</a>
            <button type="submit" class="btn btn-primary pull-right">Guardar</button>
        </div>      
    </div> 
    </form>
</div>
@endsection
@section('script-custom')
<script>
    $(function () {      
      $("#menuAdministrador" ).addClass("active" );                  
      //$("#n_idciudad" ).addClass("is-invalid" );
      $("#t_login").blur(function(){
            if(this.value==''){return; }
            $.ajax({
                url:'{!! route('administrador.login.ajax'); !!}', type: 'GET', data: { 'pidm': this.value },
            }).done(function(response) {
                if(response.status=="1"){ 
                    /*El usuario ya existe en la tabla administradores*/                    
                    toastr.error(response.msg);
                    $("#t_login" ).addClass("is-invalid" );                    
                    $("#t_login").focus();
                }else if(response.status=="2"){
                    /*El usuario no existe en banner*/
                    toastr.warning(response.msg);
                    $("#t_login" ).addClass("has-warning" );
                }else if(response.status=="3"){
                    /*Elusuario existe en banner y relleno todos los campos*/
                    $("#t_nombrecompleto").val(response.banner.nombre_completo);
                    $("#t_email").val(response.banner.email); 
                    $('#b_ldap').iCheck('check'); 
                    $("#t_login" ).removeClass("is-invalid" );                       
                    $("#t_login" ).removeClass("has-warning");                    
                    $("#t_login" ).addClass("is-valid" );                    
                    toastr.success(response.msg);

                }else{
                    $("#t_login" ).removeClass("is-invalid" );
                    $("#t_login" ).removeClass("has-warning");
                    $("#t_login" ).removeClass("is-valid");
                }
            });
	    }).focusout(function() {            
            if(this.value==''){
                $("#t_login" ).removeClass("is-invalid" );
                $("#t_login" ).removeClass("has-warning");
                $("#t_login" ).removeClass("is-valid");
            }            
        });  
                        
      
    });
  </script>
@endsection
