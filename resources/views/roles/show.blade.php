@extends('layouts.app')

@section('css')
@endsection

@section('content')
  <!-- Page Content -->
  <div class="content">
    <nav class="breadcrumb push bg-body-extra-light rounded-pill px-4 py-2">
      <a class="breadcrumb-item" href="javascript:void(0)">Roles</a>
      <span class="breadcrumb-item active">Ver</span>
    </nav>
    <!-- Dynamic Table Full -->
    <div class="block block-rounded">
      <div class="block-header block-header-default">
        <h3 class="block-title"><i class="fa fa-cogs"></i> Ver rol</h3>
        <a href="{{ route('roles.index') }}" class="btn btn-primary btn-sm" title="Regresar al listado"><i class="fa fa-arrow-left"></i> Regresar</a>
      </div>
      <div class="block-content block-content-full">
        <div class="row align-items-center">
          <div class="col-sm-6 py-2">
            <h3 class="h5 fw-bold mb-2">
              <i class="fa fa-circle text-success me-1"></i> {{ $role->name }}
            </h3>
            <p class="font-size-sm text-muted mb-0">
              Registrado el {{ date("d-m-Y H:i", strtotime($role->created_at)) }}
            </p>
            <p class="font-size-sm text-muted mb-0">
              Modificado el {{ date("d-m-Y H:i", strtotime($role->updated_at)) }}
            </p>
          </div>
          <div class="col-sm-6 py-2 text-md-end">
            <a class="btn btn-sm btn-outline-warning me-1 my-1" href="{{ route('roles.edit', $role->id) }}">
              <i class="fa fa-pencil opacity-50 me-1"></i> Editar
            </a>
          </div>
        </div>
        <div class="row">
          <div class="content">
            <h5>Listado de permisos</h5>
            @forelse ($role->permissions as $permission)
              <span class="badge rounded-pill bg-dark text-white">{{ $permission->name }}</span>
            @empty
              <span class="badge badge-danger bg-danger">Este rol no posee permisos asignados</span>
            @endforelse
          </div>
        </div>
      </div>
    </div>
    <!-- END Dynamic Table Full -->
  </div>
@endsection
