<?php
use App\Entidades\Menus;
?>

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
    /* $('.formulario').bootstrapValidator(); */
    $('input[type="checkbox"].flat-red, input[type="radio"].flat-red').iCheck({
        checkboxClass: 'icheckbox_flat-green',
        radioClass   : 'iradio_flat-green'
    });
  });
</script>

</head>
<style>
  .card-primary:not(.card-outline) > .card-header {
    background-color: #6a0d0d !important;
  }
  .btn-primary:hover {
        color: #fff;
        background-color: #6a0d0d !important ;
        border-color: #6a0d0d !important;
    }
    .btn-primary {
        color: #fff;
        background-color: #6a0d0d !important ;
        border-color: #6a0d0d !important;
    }
    .pull-left {
      float: left !important;
    }
    .pull-right {
      float: right !important;
    }
</style>
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
  <!-- Sidebar user (optional) -->
  @guest
  {{--   <div class="user-panel mt-3 pb-3 mb-3 d-flex">
      <div class="image">
        <img src="/img/usr/guest.jpg" class="img-circle elevation-2" alt="User Image">
      </div>
      <div class="info">                
        <a href="{{ route('login') }}" class="d-block">Administración</a>
      </div>
    </div> --}}
 @endguest     
      <!-- Sidebar Menu -->
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
            <p>Reportes<i class="right fas fa-angle-left"></i></p>
          </a>
          <ul class="nav nav-treeview">
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
          </ul>
        </li>
        <li class="nav-item"><a  id="menuInactivar" href="{{ route('formulario.inactivar') }}" class="nav-link"> <i class="nav-icon fas fa-eraser"></i><p>Inactivar Formulario</p></a></li>   
        @if (auth()->user()->n_id==1)
            <li class="nav-item"><a  id="menuAdministrador" href="{{ route('administrador.listar') }}" class="nav-link"> <i class="nav-icon fas fa-users-cog"></i><p>Administradores</p></a></li>    
            <li class="nav-item"><a  id="menuPerfil" href="{{ route('administrador.perfil') }}" class="nav-link"> <i class="nav-icon fas fa-user-tie"></i><p>Cambio Contraseña</p></a></li>
            <li class="nav-item"><a  id="menuUsuario" href="{{ route('users.index') }}" class="nav-link"> <i class="nav-icon fas fa-user"></i><p>Usuarios</p></a></li>
            {{-- <li class="nav-item"><a  id="menuSedes" href="{{ route('sedes.index') }}" class="nav-link"> <i class="nav-icon fas fa-university"></i><p>Sedes</p></a></li>  --}}        
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
            {{-- <button type="button" class="btn btn-tool" data-card-widget="collapse" data-toggle="tooltip" title="Collapse">
              <i class="fas fa-minus"></i></button> --}}
            {{-- <button type="button" class="btn btn-tool" data-card-widget="remove" data-toggle="tooltip" title="Remove"> --}}
              {{-- <i class="fas fa-times"></i></button> --}}
          </div>
        </div>
        <div class="card-body">
         

@yield('content')
        </div>
        <!-- /.card-body -->
        
      </div>
      <!-- /.card -->
{{-- @yield('content_1') --}}
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
  @yield('script-custom')
  <footer class="main-footer">
    <div class="float-right d-none d-sm-block">      
      <b><a class="info user-panel d-flex" href="{{ route('login') }}" class="d-block">Admin UPB</a></b>
    </div>
    <strong><center>Universidad Pontificia Bolivariana.<center></footer>

  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
  </aside>
  <!-- /.control-sidebar -->
</div>
<!-- ./wrapper -->
@include('partials.notification')

</body>
</html>
