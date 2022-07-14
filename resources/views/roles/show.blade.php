@extends('layouts.app')

@section('css')
@endsection

@section('content')
  <!-- Page Content -->
  <div class="content">
    <nav class="breadcrumb bg-white push">
      <a class="breadcrumb-item" href="javascript:void(0)">Roles</a>
      <span class="breadcrumb-item active">Ver</span>
    </nav>
    <!-- Dynamic Table Full -->
    <div class="block">
      <div class="block-header block-header-default">
        <h3 class="block-title"><i class="fa fa-cogs"></i> Ver rol</h3>
        <a href="{{ route('roles.index') }}" class="btn btn-primary btn-sm" title="Regresar al listado"><i class="fa fa-arrow-left"></i> Regresar</a>
      </div>
      <div class="block-content block-content-full">
        <div class="col-sm-12 py-10">
          <h3 class="h5 font-w700 mb-10">
            <i class="fa fa-circle text-success mr-5"></i> {{ $role->name }}
          </h3>
          <p class="font-size-sm text-muted mb-0">
            Registrado el {{ date("d-m-Y H:i", strtotime($role->created_at)) }}
          </p>
          <p class="font-size-sm text-muted mb-0">
            Modificado el {{ date("d-m-Y H:i", strtotime($role->updated_at)) }}
          </p>
          <hr>
          <h5>Listado de permisos</h5>
          @forelse ($role->permissions as $permission)
            <span class="badge rounded-pill bg-dark text-white">{{ $permission->name }}</span>
          @empty
            <span class="badge badge-danger bg-danger">Este rol no posee permisos asignados</span>
          @endforelse
        </div>
      </div>
    </div>
    <!-- END Dynamic Table Full -->
  </div>
@endsection
