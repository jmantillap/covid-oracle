
<!--
    <ul>
        <li class="{{ setActive('home') }}"><a href="<?php echo route('home');?>">@lang('Home')</a></li>
        <li class="{{ setActive('portafolio') }}"><a href="<?php echo route('proyectos.index');?>">@lang('Portfolio')</a></li>
        <li class="{{ setActive('contact') }}"><a href="<?php echo route('contact');?>">@lang('Contacts')</a></li>
        <li class="{{ setActive('saludos') }}"><a href="<?php echo route('saludos');?>">@lang('Saludos')</a></li>
    </ul>
-->
@auth
    <ul class="navbar-nav bg-white shadow-sm">
        <li class="nav-item">
          <a class="nav-link" data-widget="pushmenu" href="#"><i class="fas fa-bars"></i></a>
        </li>
        <li class="nav-item d-none d-sm-inline-block">
          <a href="<?php echo route('home');?>" class="nav-link">Home</a>
        </li>
        <li class="nav-item d-none d-sm-inline-block">
          <a href="<?php echo route('docentes.index');?>" class="nav-link">Docentes</a>
        </li>
        <li class="nav-item d-none d-sm-inline-block">
          <a href="<?php echo route('proyectos.index');?>" class="nav-link">Proyectos</a>
        </li>
        <li class="nav-item d-none d-sm-inline-block">
            <a href="<?php echo route('contact');?>" class="nav-link">Contactos</a>
          </li>
          <li class="nav-item d-none d-sm-inline-block">
            <a href="<?php echo route('administracion.index');?>" class="nav-link">Administración</a>
          </li>
          <li class="nav-item d-none d-sm-inline-block">
            
          </li>

         

      </ul>
@endauth
      