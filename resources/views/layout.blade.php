<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  {{-- <title>Covid Oracle</title> --}}
  <title>@yield('title','Covid Oracle')</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <!-- Font Awesome -->
  <link rel="stylesheet" href="/plugins/fontawesome-free/css/all.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
  <!-- overlayScrollbars -->
  <link rel="stylesheet" href="/plugins/datatables-bs4/css/dataTables.bootstrap4.css">
  <link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.2.3/css/responsive.bootstrap4.min.css">
  <link rel="stylesheet" href="/dist/css/adminlte.min.css">
  <!-- Google Font: Source Sans Pro -->
  <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
  <link rel="stylesheet" href= "https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">   
<!-- jQuery -->
<script src="/plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="/plugins/bootstrap/js/bootstrap.min.js"></script>
<!-- <link rel="stylesheet" href="/plugins/bootstrap/css/bootstrap.min.css">-->
<!-- AdminLTE App -->
<script src="/plugins/datatables/jquery.dataTables.js"></script>
<script src="/plugins/datatables-buttons/js/dataTables.buttons.min.js"></script>
<script src="/plugins/datatables-buttons/js/buttons.flash.min.js"></script>
<script src="/plugins/datatables-buttons/js/buttons.html5.min.js"></script>
<script src="/plugins/datatables-buttons/js/buttons.bootstrap4.min.js"></script>
<script src="/plugins/datatables-bs4/js/dataTables.bootstrap4.js"></script>
<script src="/plugins/datatables-buttons/js/buttons.print.js"></script>
<script src="/plugins/iCheck/icheck.min.js"></script>
<script src="https://cdn.datatables.net/1.10.20/js/dataTables.bootstrap4.min.js"></script>
<script src="https://cdn.datatables.net/responsive/2.2.3/js/dataTables.responsive.min.js"></script>
<script src="https://cdn.datatables.net/responsive/2.2.3/js/responsive.bootstrap4.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js" type="text/javascript"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js" type="text/javascript"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js" type="text/javascript"></script>
<!-- ickeck -->
<link rel="stylesheet" href="/plugins/iCheck/all.css">
<script src="/plugins/iCheck/icheck.min.js"></script>
<!-- validator -->
<!-- ---- -->
<!-- jquery-validation -->
<script src="/plugins/jquery-validation/jquery.validate.min.js"></script>
<script src="/plugins/jquery-validation/additional-methods.min.js"></script>
<!-- ---- -->
<script src="/dist/js/adminlte.min.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="/dist/js/demo.js"></script>
<script>  
  $(function () {        
    $('input[type="checkbox"].flat-red, input[type="radio"].flat-red').iCheck({
        checkboxClass: 'icheckbox_flat-green',
        radioClass   : 'iradio_flat-green'
    });
    $(".numero").keypress(function (e) {
        if (e.event){ key = e.keyCode;}else{key = e.which;}
        if (key == 0) {            return true;                    }
        if (key == 8) {            return true;                    }
        if (key == 46) {            return false;                    }
        if (key < 46 || key > 57) {            return false;        }
    });
  });
</script>
</head>
<style>
  .card-primary:not(.card-outline) > .card-header {    background-color: #6a0d0d !important;  }
  .btn-primary:hover {        color: #fff;        background-color: #6a0d0d !important ;        border-color: #6a0d0d !important;    }
  .btn-primary {        color: #fff;        background-color: #6a0d0d !important ;        border-color: #6a0d0d !important;    }
  .pull-left {      float: left !important;    }
  .pull-right {      float: right !important;    }
  .bordes{      border-radius: 10px !important;    }
</style>
@include('partials.notification')
<body class="hold-transition sidebar-mini">
<!-- Site wrapper -->
<div class="wrapper">
  <!-- Navbar -->
  <nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
      </li> 
      <li class="nav-item d-none d-sm-inline-block">
        <a href="#" class="nav-link"></a>
      </li>   
    </ul>
  </nav>
  <!-- /.navbar -->
<!-- Main Sidebar Container -->
<aside class="main-sidebar sidebar-dark-primary elevation-4">
<!-- Brand Logo -->
<a href="{{ route('home') }}" class="brand-link">
  <img src="/dist/img/AdminLTELogo.png"
        alt="AdminLTE Logo"
        class="brand-image img-circle elevation-3"
        style="opacity: .8">
  <span class="brand-text font-weight-light">Formulario COVID-19</span>
</a>
<!-- Sidebar -->      
<div class="sidebar">
@guest  
    @if (Session::has('userUPB') && Session::get('userUPB')->n_idusuario!=null)
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          @if (App\Services\FormularioServices::getFormularioEncuestaHoy()==null)
            <li class="nav-item"><a href="{{ route('formularioupb.create') }}" class="nav-link"> <i class="nav-icon fas fa-file-signature"></i><p>Llenar Encuesta Diaria</p></a></li>    
            <li class="nav-header">
              <div class="position-relative p-3 bg-danger bordes" ><div class="ribbon-wrapper "><div class="ribbon bg-danger ">Llenar</div></div><h5>Encuesta Diaria</h5></div>
            </li>              
          @endif
          @if (App\Services\FormularioServices::getActaCovid()==null)
            <li class="nav-item"><a href="{{ route('acta.usuario.upb') }}" class="nav-link"> <i class="nav-icon fas fa-file-signature"></i><p>Llenar Acta COVID-19</p></a></li>    
            <li class="nav-header">
              <div class="position-relative p-3 bg-danger bordes" ><div class="ribbon-wrapper"><div class="ribbon bg-danger">Llenar</div></div><h5>Acta COVID-19</h5></div>
            </li> 
          @endif
          @if (App\Services\FormularioServices::getEncuestaComorbilidad()==null)
            <li class="nav-item">
              <a id="menuEncuestaComorbilidad" href="{{ route('encuesta.comorbilidad.upb') }}" class="nav-link"> <i class="nav-icon fas fa-file-signature"></i><p>Llenar Estado de Salud</p></a></li>    
            <li class="nav-header">
              <div class="position-relative p-3 bg-danger bordes" ><div class="ribbon-wrapper"><div class="ribbon bg-danger">Llenar</div></div><h5>Estado de Salud</h5></div>
            </li> 
          @endif
          <li class="nav-header"></li> 
          <li class="nav-item"><a href="{{ route('salir.usuario.upb') }}" class="nav-link"><i class="nav-icon fas fa-sign-out-alt"></i><p>Salir Usuario UPB</p></a></li>          
        </ul>  
      </nav>        
    @elseif(!Session::has('userUPB') && Session::has('idUsuario') && Session::get('idUsuario')!=null )  
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          @if (App\Services\FormularioServices::getFormularioEncuestaHoy()==null)
            <li class="nav-item"><a href="{{ route('formulario.create') }}" class="nav-link"> <i class="nav-icon fas fa-file-signature"></i><p>Llenar Encuesta Diaria</p></a></li>    
            <li class="nav-header">
              <div class="position-relative p-3 bg-danger bordes" ><div class="ribbon-wrapper "><div class="ribbon bg-danger ">Llenar</div></div><h5>Encuesta Diaria</h5></div>
            </li>     
          @endif
          @if (App\Services\FormularioServices::getActaCovid()==null)
              <li class="nav-item"><a href="{{ route('acta.usuario.upb') }}" class="nav-link"> <i class="nav-icon fas fa-file-signature"></i><p>Llenar Acta COVID-19</p></a></li>    
              <li class="nav-header">
                <div class="position-relative p-3 bg-danger bordes" ><div class="ribbon-wrapper"><div class="ribbon bg-danger">Llenar</div></div><h5>Acta COVID-19</h5></div>
              </li> 
          @endif

          <li class="nav-header"></li> 
          <li class="nav-item"><a href="{{ route('salir.usuario.visitante') }}" class="nav-link"><i class="nav-icon fas fa-sign-out-alt"></i><p>Salir Usuario Visitante</p></a></li>                    
        </ul>  
      </nav>                
    @endif
    @if (((Session::has('idUsuario') && ($usuario=\App\User::find(Session::get('idUsuario')))!=null) ||
          (Session::has('userUPB') && ($usuario=\App\User::find(Session::get('userUPB')->n_idusuario))!=null)) 
          || (Route::currentRouteName()=='formulario.show' && $formulario!=null  && $formulario->usuario!=null)
        ) {{-- && $usuario->t_sigaa=='SI' --}}          
        @php
          if(Route::currentRouteName()=='formulario.show' && $formulario!=null  && $formulario->usuario!=null){
            $usuario=$formulario->usuario;
          }
          $encuestas=App\Services\FormularioServices::getEncuestasLlenas($usuario->n_idusuario);
          $bloqueo=0;
          foreach ($encuestas as $encu) { 
            if($encu->encuesta!='C' &&  $encu->semaforo>1){  $bloqueo++; } 
          }
        @endphp          
        @if ((count($encuestas)<3  && $usuario->t_sigaa=='SI') || (count($encuestas)<2  && $usuario->t_sigaa=='NO'))
          <script>            
            toastr.error('* No tiene autorizado ingreso al campus. Falta llenar alguna(s) Encuesta(s).'); //mensaje
          </script>
          <nav class="mt-2">
            <div class="alert alert-danger alert-dismissible">            
              <h5><i class="icon fas fa-ban"></i> Alerta!</h5>
              * No tiene autorizado ingreso al campus. Falta llenar alguna(s) Encuesta(s).
            </div>
          </nav>   
        @endif        
        @if ($bloqueo>0)
          {{-- @php \Session::flash('status', 'Bloqueo');                @endphp --}}
          <script>            
            toastr.warning('* No tiene autorizado ingreso al campus. [{{ $bloqueo }}] encuesta(s) tiene(n) Bloqueo.'); //mensaje
          </script>
          <nav class="mt-2">
            <div class="alert alert-warning alert-dismissible">            
              <h5><i class="icon fas fa-info"></i> Alerta!</h5>
              * No tiene autorizado ingreso al campus. [{{ $bloqueo }}] encuesta(s) tiene(n) Bloqueo.
            </div>
          </nav>            
        @endif
        @if ($bloqueo==0 && ((count($encuestas)==3  && $usuario->t_sigaa=='SI') || (count($encuestas)==2  && $usuario->t_sigaa=='NO')) )
        <script>            
          toastr.success('* Puede ingresar al campus y no tiene Bloqueo.'); //mensaje
        </script>
          <nav class="mt-2">
            <div class="alert alert-success alert-dismissible">            
              <h5><i class="icon fas fa-check"></i> APROBADO</h5>
              * Puede ingresar al campus y no tiene Bloqueo.
            </div>
          </nav>            
        @endif      

    @endif        
@endguest           
@auth
    <div class="user-panel mt-3 pb-3 mb-3 d-flex">
      <div class="image">
        <img src="/img/usr/guest.jpg" class="img-circle elevation-2" alt="User Image">
      </div>
      <div class="info">                
      <a href="#" class="d-block">{{auth()->user()->t_nombrecompleto}}</a>
      </div>
    </div>
    <nav class="mt-2">
      <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
        <!-- Add icons to the links using the .nav-icon class
            with font-awesome or any other icon font library -->
        <li class="nav-item"><a id="menuHome"  href="{{ route('home') }}" class="nav-link"><p>Página Inicial</p></a></li>    
        <li class="nav-header">MENU PRINCIPAL</li> 
        <li class="nav-item"><a id="menuEstadistica" href="{{ route('estadistica') }}" class="nav-link"> <i class="nav-icon fas fa-chart-pie"></i><p>Estadisticas</p></a></li>            
        <li id="menuReportes" class="nav-item has-treeview">
          <a href="#" class="nav-link" >
            <i class="nav-icon fas fa-file-invoice"></i>
            <p>Reporte Encuesta Diaria<i class="right fas fa-angle-left"></i></p>
          </a>
          <ul class="nav nav-treeview">
            <li class="nav-item"><hr  style="height:2px;border-width:0;color:gray;background-color:white"  /></li>    
            <li class="nav-item">
              <a id="menuReporte1" href="{{ route('reportes.reporte1') }}" class="nav-link">
                <i class="nav-icon fas fa-exclamation-triangle"></i><p>Críticos x Periodo</p>
              </a>
            </li>
            <li class="nav-item">
              <a id="menuReporte2" href="{{ route('reportes.reporte2') }}" class="nav-link">
                <i class="nav-icon fas fa-users"></i><p>Todos x Periodo</p>
              </a>
            </li>
            <li class="nav-item">
              <a  id="menuReporte3" href="{{ route('reportes.reporte3') }}" class="nav-link">
                <i class="nav-icon fas fa-diagnoses"></i><p>Trazabilidad de usuario</p>
              </a>
            </li>
            <li class="nav-item">
              <a  id="menuReporte4" href="{{ route('reportes.reporte4') }}" class="nav-link">
                <i class="nav-icon fas fa-bed"></i><p>Usuarios No Reportaron</p>
              </a>
            </li>
            <li class="nav-item">
              <a  id="menuReporteDiariaEmpleados" href="{{ route('reportes.encuestadiaria.empleados') }}" class="nav-link">
                <i class="nav-icon fas fa-calendar-day"></i><p>Diaria Empleados UPB</p>
              </a>
            </li>
            <li class="nav-item">
              <a  id="menuReporteVacunacioEmpleados" href="{{ route('reportes.vacunacion.empleados') }}" class="nav-link">
                <i class="nav-icon fas fa-syringe"></i><p>Vacunación Empleados</p>                
              </a>
            </li>
            {{-- <li class="nav-item">
              <a  id="menuReporte5" href="{{ route('reportes.estado.salud') }}" class="nav-link">
                <i class="nav-icon fas fa-heartbeat"></i><p>Estado de Salud</p>
              </a>
            </li> --}}
            <li class="nav-item"><hr  style="height:2px;border-width:0;color:gray;background-color:white"  /></li>    
          </ul>
        </li>
        <li id="menuReporteComorbilidad" class="nav-item has-treeview">
          <a href="#" class="nav-link" >
            <i class="nav-icon fas fa-file-invoice"></i>
            <p>Reportes Estado Salud<i class="right fas fa-angle-left"></i></p>
          </a>
          <ul class="nav nav-treeview">
            <li class="nav-item"><hr  style="height:2px;border-width:0;color:gray;background-color:white"  /></li>                
            <li class="nav-item">
              <a  id="menuReporte5" href="{{ route('reportes.estado.salud') }}" class="nav-link">
                <i class="nav-icon fas fa-heartbeat"></i><p>Estado de Salud</p>
              </a>
            </li>
            <li class="nav-item">
              <a  id="menuReporte6" href="{{ route('reportes.estado.salud.datos') }}" class="nav-link">
                <i class="nav-icon fas fa-heartbeat"></i><p>Estado Salud Datos</p>
              </a>
            </li>
            <li class="nav-item"><hr  style="height:2px;border-width:0;color:gray;background-color:white"  /></li>    
          </ul>
        </li>
        <li class="nav-item"><a  id="menuInactivar" href="{{ route('formulario.inactivar') }}" class="nav-link"> 
              <i class="nav-icon fas fa-eraser"></i><p>Inactivar Encuesta Ingreso</p></a></li>   
        <li class="nav-item">
            <a  id="menuInactivarEncuestaCovid" href="{{ route('acta.covid19.inactivar') }}" class="nav-link"> 
            <i class="nav-icon fas fa-backspace"></i><p>Inactivar Acta Covid</p></a>
        </li>
        <li class="nav-item">
          <a  id="menuInactivarVacunacion" href="{{ route('encuesta.vacunacion.inactivar') }}" class="nav-link"> 
          <i class="nav-icon fas fa-syringe"></i><p>Inactivar Vacunación</p></a>          
       </li>
        <li class="nav-item">
          <a  id="menuInactivarComorbilidad" href="{{ route('encuesta.comorbilidad.inactivar') }}" class="nav-link"> 
          <i class="nav-icon fas fa-folder-minus"></i><p>Inactivar Estado de Salud</p></a>
        </li>   
        <li class="nav-item">
          <a  id="menuActualizarComorbilidad" href="{{ route('encuesta.comorbilidad.actualizar') }}" class="nav-link"> 
          <i class="nav-icon fas fa-save"></i><p>Actualizar Estado de Salud</p></a>
        </li>   
        
        @if (auth()->user()->n_id==1 || auth()->user()->n_id==101 )
            <li class="nav-item"><a  id="menuAdministrador" href="{{ route('administrador.listar') }}" class="nav-link"> <i class="nav-icon fas fa-users-cog"></i><p>Administradores</p></a></li>    
            <li class="nav-item"><a  id="menuPerfil" href="{{ route('administrador.perfil') }}" class="nav-link"> <i class="nav-icon fas fa-user-tie"></i><p>Cambio Contraseña</p></a></li>
            <li class="nav-item"><a  id="menuUsuario" href="{{ route('users.index') }}" class="nav-link"> <i class="nav-icon fas fa-user"></i><p>Usuarios</p></a></li>            
            <li id="menuTablas" class="nav-item has-treeview">
              <a href="#" class="nav-link">
                <i class="nav-icon fas fa-table"></i>
                <p>Tablas Básicas<i class="right fas fa-angle-left"></i></p>
              </a>
              <ul class="nav nav-treeview">
                <li class="nav-item">
                  <a id="menuSedes" href="{{ route('sedes.index') }}" class="nav-link">
                    <i class="nav-icon fas fa-university"></i><p>Sedes</p>
                  </a>
                </li>
                <li class="nav-item">
                  <a id="menuCiudad" href="{{ route('ciudad.listar') }}" class="nav-link">
                    <i class="nav-icon fas fa-city"></i><p>Ciudades</p>
                  </a>
                </li>            
              </ul>
            </li>
        @endif        
        @if (auth()->user()->n_id==1)
        
        @endif        
        <li class="nav-item"><a href="{{ route('logout') }}" class="nav-link"> <i class="nav-icon fas fa-sign-out-alt"></i><p>Salir</p></a></li>    

      </ul>
    </nav>
@endauth
<!-- Quitado por japefuloni, consulte la barra de navegacion original de adminlte    -->
@yield('menu')      
<!-- /.sidebar-menu -->      
</div>    
</aside>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>@yield('titulopag', 'Pag sin Titulo')</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item">@yield('elcontrolador','Controlador')</li>
              <li class="breadcrumb-item active">@yield('laaccion','Accion')</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
      <!-- Default box -->
      <div class="card card-primary">
        <div class="card-header">
          <h3 class="card-title">@yield('laaccion','laaccion')</h3>
          <div class="card-tools">          
          </div>
        </div>
        <div class="card-body">
          @yield('content')
        </div>
        <!-- /.card-body -->        
      </div>
      <!-- /.card -->  
      @yield('acta')
      @yield('comorbilidad')
    </section>
    <!-- /.content -->
</div>
 <!-- /.content-wrapper -->
@yield('script-custom')
<footer class="main-footer">
    <div class="float-right d-none d-sm-block">      
      <b><a class="info user-panel d-flex" href="{{ route('login') }}" class="d-block">Admin UPB</a></b>
    </div>
    <strong><center>Universidad Pontificia Bolivariana.</center>    
</footer>
  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
  </aside>
  <!-- /.control-sidebar -->
</div>
<!-- ./wrapper -->
{{-- @include('partials.session-status') --}}
</body>
</html>
{{-- @else    
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">                    
        @if (Session::has('idUsuario') && App\Services\FormularioServices::getActaCovid()==null )
              <li class="nav-header">ALERTAS 1</li> 
              <li class="nav-header">
                <div class="position-relative p-3 bg-danger bordes" ><div class="ribbon-wrapper"><div class="ribbon bg-danger">Llenar</div></div><h5>Acta COVID-19</h5></div>
              </li> 
        @elseif(Route::currentRouteName()=='formulario.show' && $formulario!=null  && $formulario->usuario!=null  && $formulario->usuario->t_sigaa=='SI' )       

              {{ dd($formulario->usuario->t_sigaa) }}              
              
             
        @endif  
        </ul>  
      </nav>           --}}

{{-- @if (($form=App\Services\FormularioServices::getActaCovid())!=null)              
              <li class="nav-header">
              <div class="position-relative p-3 {{ $form->n_semaforo==1 ? 'bg-success' : 'bg-danger' }} bordes" >
                <div class="ribbon-wrapper"><div class="ribbon {{ $form->n_semaforo==1 ? 'bg-success' : 'bg-danger' }} ">{{ $form->n_idformulario_acta }}</div></div>
                <h5>Acta COVID-19</h5>
              </div>
              </li>
          @else
              <li class="nav-header">ALERTAS</li> 
              <li class="nav-header">
                <div class="position-relative p-3 bg-danger bordes" ><div class="ribbon-wrapper"><div class="ribbon bg-danger">Llenar</div></div><h5>Acta COVID-19</h5></div>
              </li> 
          @endif             --}}