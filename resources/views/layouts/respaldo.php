<nav id="sidebar">  
  <div class="sidebar-content">    
    <div class="content-header justify-content-lg-center">      
      <div>
        <span class="smini-visible fw-bold tracking-wide fs-lg">
          l<span class="text-primary">c</span>
        </span>
        <a class="link-fx fw-bold tracking-wide mx-auto" href="{{ route('home') }}">
          <span class="smini-hidden">
            <i class="fa fa-fire text-primary"></i>
            <span class="fs-4 text-dual">Like</span><span class="fs-4 text-primary">Código</span>
          </span>
        </a>
      </div>
      <div>
        <button type="button" class="btn btn-sm btn-alt-danger d-lg-none" data-toggle="layout" data-action="sidebar_close">
          <i class="fa fa-fw fa-times"></i>
        </button>        
      </div>      
    </div>
    <div class="js-sidebar-scroll">      
      <div class="content-side content-side-user px-0 py-0">        
        <div class="smini-visible-block animated fadeIn px-3">
          <img class="img-avatar img-avatar32" src="{{ asset('media/various/little-face.png') }}" alt="">
        </div>
        <div class="smini-hidden text-center mx-auto">
          <a class="img-link" href="#">
            <img class="img-avatar" src="{{ asset('media/various/little-face.png') }}" alt="">
          </a>
          <ul class="list-inline mt-3 mb-0">
            <li class="list-inline-item">
              <a class="link-fx text-dual fs-sm fw-semibold text-uppercase" href="#">
                {!! empty(\Auth::User()->empresa->nombre)?\Auth::User()->tipo_usuario->nombre:\Auth::User()->empresa->nombre !!}
              </a>
            </li>
            <li class="list-inline-item">
              <label for="tema" style="cursor: pointer;"><span id="icono_tema" data-bs-toggle="tooltip" data-bs-placement="top" title="Cambiar tema"></span></label>
              <input type="checkbox" name="tema" value="1" id="tema" style="display: none;" @if(tema()==1) checked="true" @endif)>
            </li>
            <li class="list-inline-item">
              <a class="link-fx text-dual" href="{!! route('logout') !!}" data-bs-toggle="tooltip" data-bs-placement="right" title="Cerrar sesión" onclick="event.preventDefault(); document.getElementById('logout-form-sidebar').submit();">
                <form id="logout-form-sidebar" action="{{ route('logout') }}" method="POST" class="d-none">@csrf</form>
                <i class="fa fa-sign-out-alt text-danger"></i>
              </a>
            </li>
          </ul>
        </div>        
      </div>
      <div class="content-side content-side-full">
        <ul class="nav-main">
          <li class="nav-main-item">
            <a class="nav-main-link {{ request()->is('home') ? ' active' : '' }}" href="{{ route('home') }}" href="{{ route('home') }}">
              <i class="nav-main-link-icon fa fa-user"></i>
              <span class="nav-main-link-name">Dashboard</span>
            </a>
          </li>
          <li class="nav-main-item">
            <a class="nav-main-link {{ request()->is('empresas*') ? ' active' : '' }}" href="{{ route('empresas.index') }}">
              <i class="nav-main-link-icon fa fa-building"></i>
              <span class="nav-main-link-name">Empresas</span>
            </a>
          </li>
          <li class="nav-main-item">
            <a class="nav-main-link {{ request()->is('consultorios*') ? ' active' : '' }}" href="{{ route('consultorios.index') }}">
              <i class="nav-main-link-icon fa fa-hospital"></i>
              <span class="nav-main-link-name">Consultorios</span>
            </a>
          </li>
          <li class="nav-main-item">
            <a class="nav-main-link {{ request()->is('medicos*') ? ' active' : '' }}" href="{{ route('medicos.index') }}">
              <i class="nav-main-link-icon fa fa-user-doctor"></i>
              <span class="nav-main-link-name">Médicos</span>
            </a>
          </li>
          <li class="nav-main-item">
            <a class="nav-main-link {{ request()->is('pacientes*') ? ' active' : '' }}" href="{{ route('pacientes.index') }}">
              <i class="nav-main-link-icon fa fa-user-tie"></i>
              <span class="nav-main-link-name">Pacientes</span>
            </a>
          </li>
          <li class="nav-main-item">
            <a class="nav-main-link {{ request()->is('especialidades*') ? ' active' : '' }}" href="{{ route('especialidades.index') }}">
              <i class="nav-main-link-icon fa-solid fa-stethoscope"></i>
              <span class="nav-main-link-name">Especialidades</span>
            </a>
          </li>
          <li class="nav-main-item">
            <a class="nav-main-link {{ request()->is('servicios*') ? ' active' : '' }}" href="{{ route('servicios.index') }}">
              <i class="nav-main-link-icon fa-solid fa-tooth"></i>
              <span class="nav-main-link-name">Servicios</span>
            </a>
          </li>
          <li class="nav-main-item">
            <a class="nav-main-link {{ request()->is('citas*') ? ' active' : '' }}" href="{{ route('citas.index') }}">
              <i class="nav-main-link-icon fa-solid fa-clock"></i>
              <span class="nav-main-link-name">Citas</span>
            </a>
          </li>
          <li class="nav-main-heading">Administración</li>
          <li class="nav-main-item">
            <a class="nav-main-link nav-main-link-submenu" data-toggle="submenu" aria-haspopup="true" aria-expanded="false" href="#">
              <i class="nav-main-link-icon fa fa-grip-vertical"></i>
              <span class="nav-main-link-name">Panel de control</span>
            </a>
            <ul class="nav-main-submenu">
              <li class="nav-main-item">
                <a class="nav-main-link" href="{{ route('users.index') }}">
                  <span class="nav-main-link-name">Usuarios</span>
                </a>
              </li>
              <li class="nav-main-item">
                <a class="nav-main-link" href="{{ route('roles.index') }}">
                  <span class="nav-main-link-name">Roles</span>
                </a>
              </li>
              <li class="nav-main-item">
                <a class="nav-main-link" href="{{ route('permissions.index') }}">
                  <span class="nav-main-link-name">Permisos</span>
                </a>
              </li>
            </ul>
          </li>
          <li class="nav-main-item">
            <a class="nav-main-link {{ request()->is('home') ? ' active' : '' }}" href="{{ route('home') }}" href="{{ route('home') }}">
              <i class="nav-main-link-icon fa fa-cogs"></i>
              <span class="nav-main-link-name">Administrador</span>
            </a>
          </li>
        </ul>
      </div>      
    </div>    
  </div>  
</nav>