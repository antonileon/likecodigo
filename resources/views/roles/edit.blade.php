@extends('layouts.app')

@section('css')
@endsection

@section('content')
  <!-- Page Content -->
  <div class="content">
    <nav class="breadcrumb push bg-body-extra-light rounded-pill px-4 py-2">
      <a class="breadcrumb-item" href="javascript:void(0)">Roles</a>
      <span class="breadcrumb-item active">Editar</span>
    </nav>
    <!-- Dynamic Table Full -->
    <div class="block block-rounded">
      <div class="block-header block-header-default">
        <h3 class="block-title"><i class="fa fa-cogs"></i> Editar rol</h3>
        <a href="{{ route('roles.index') }}" class="btn btn-primary btn-sm" title="Regresar al listado"><i class="fa fa-arrow-left"></i> Regresar</a>
      </div>
      <form method="POST" action="{{ route('roles.update', $role->id) }}" class="form-horizontal">
        @csrf
        @method('PUT')
        <div class="block-content block-content-full">
          <p class="text-center">Todos los campos con <b style="color:red;">*</b> son obligatorio.</p>
          <div class="col-md-12">
            <div class="row mb-4">
              <div class="col-md-12">
                <div class="form-group">
                  <label for="name" class="form-label">Nombre <b style="color:red;">*</b></label>
                  <input type="text" name="name" id="name" class="form-control mb-1" value="{{ $role->name }}">
                </div>
                @error('name')
                  <div class="alert alert-danger">{{ $message }}</div>
                @enderror
              </div>
            </div>
            <div class="row" style="font-size:14px;">
              <h4>Lista de permisos</h4>
              @foreach ($permissions as $id => $permission)
              <div class="col-md-3">
                <div class="form-check form-switch">
                  <input class="form-check-input" type="checkbox" value="{{ $id }}" id="{{ $id }}" name="permissions[]" {{ $role->permissions->contains($id) ? 'checked' : '' }}>
                  <label class="form-check-label" for="{{ $id }}">{{ $permission }}</label>
                </div>
              </div>
              @endforeach
            </div>
          </div>
        </div>
        <div class="block-content block-content-full block-content-sm bg-body-light text-end">
          <button type="reset" class="btn btn-alt-secondary">
            <i class="fa fa-sync-alt opacity-50 me-1"></i> Limpiar
          </button>
          <button type="submit" class="btn btn-alt-primary" title="Modificar">
            <i class="fa fa-check opacity-50 me-1"></i> Modificar
          </button>
        </div>
      </form>
    </div>
    <!-- END Dynamic Table Full -->
  </div>
@endsection
