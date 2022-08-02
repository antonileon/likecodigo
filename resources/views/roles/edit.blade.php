@extends('layouts.app')

@section('css')
@endsection

@section('content')
  <!-- Page Content -->
  <div class="content">
    <nav class="breadcrumb bg-white push">
      <a class="breadcrumb-item" href="javascript:void(0)">Roles</a>
      <span class="breadcrumb-item active">Editar</span>
    </nav>
    <!-- Dynamic Table Full -->
    <div class="block">
      <div class="block-header block-header-default">
        <h3 class="block-title"><i class="fa fa-cogs"></i> Editar rol</h3>
        <a href="{{ route('roles.index') }}" class="btn btn-primary btn-sm" title="Regresar al listado"><i class="fa fa-arrow-left"></i> Regresar</a>
      </div>
      <div class="block-content block-content-full">
        <p class="text-center">Todos los campos con <b style="color:red;">*</b> son obligatorio.</p>
        <form method="POST" action="{{ route('roles.update', $role->id) }}" class="form-horizontal">
          @csrf
          @method('PUT')
          <div class="col-md-12">
            <div class="row">
              <div class="col-md-12">
                <div class="form-group">
                  <label for="name">Nombre <b style="color:red;">*</b></label>
                  <input type="text" name="name" id="name" class="form-control" value="{{ $role->name }}">
                </div>
                @error('name')
                  <div class="alert alert-danger">{{ $message }}</div>
                @enderror
              </div>
            </div>
            <h4>Lista de permisos</h4>
            <div class="row">
              @foreach ($permissions as $id => $permission)
              <div class="col-md-3">
                <label class="css-control css-control-sm css-control-success css-switch">
                  <input type="checkbox" class="css-control-input" name="permissions[]" value="{{ $id }}" {{ $role->permissions->contains($id) ? 'checked' : '' }}>
                  <span class="css-control-indicator"></span> {{ $permission }}
                </label>                  
              </div>
              @endforeach
            </div>
            <hr>
            <div class="row justify-content-center text-center">
              <div class="col-12">
                <div class="form-group">
                  <button type="submit" class="btn btn-alt-primary" title="Modificar"><i class="fa fa-edit"></i> Modificar</button>
                </div>
              </div>
            </div>
          </div>
        </form>
      </div>
    </div>
    <!-- END Dynamic Table Full -->
  </div>
@endsection
