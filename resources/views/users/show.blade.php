@extends('layouts.app')

@section('css')
  <!-- Page JS Plugins CSS -->
  <link rel="stylesheet" href="{{ asset('js/plugins/datatables/dataTables.bootstrap4.css') }}">
@endsection

@section('content')
  <!-- Page Content -->
  <div class="content">
    <nav class="breadcrumb bg-white push">
      <a class="breadcrumb-item" href="javascript:void(0)">Usuarios</a>
      <span class="breadcrumb-item active">Ver</span>
    </nav>
    <!-- Dynamic Table Full -->
    <div class="block">
      <div class="block-header block-header-default">
        <h3 class="block-title"><i class="fa fa-user"></i> Ver usuario</h3>
        <a href="{{ route('users.index') }}" class="btn btn-primary btn-sm" title="Regresar al listado"><i class="fa fa-arrow-left"></i> Regresar</a>
      </div>
      <div class="block-content block-content-full">
        <div class="row">
          <div class="col-md-3">
            <div class="form-group">
              <label>Empresa</label>
              <div class="form-control-plaintext">{{ empty($user->empresa->nombre)?'N/A':$user->empresa->nombre }}</div>
            </div>
          </div>
          <div class="col-md-3">
            <div class="form-group">
              <label>Tipo de usuario</label>
              <div class="form-control-plaintext">{{ $user->tipo_usuario->nombre }}</div>
            </div>
          </div>
          <div class="col-md-3">
            <div class="form-group">
              <label>Nombre</label>
              <div class="form-control-plaintext">{{ $user->nombre }}</div>
            </div>
          </div>
          <div class="col-md-3">
            <div class="form-group">
              <label>Apellido</label>
              <div class="form-control-plaintext">{{ $user->apellido }}</div>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-md-3">
            <div class="form-group">
              <label>Email</label>
              <div class="form-control-plaintext">{{ $user->email }}</div>
            </div>
          </div>
          <div class="col-md-3">
            <div class="form-group">
              <label>Nombre de usuario</label>
              <div class="form-control-plaintext">{{ $user->nombre_usuario }}</div>
            </div>
          </div>
          <div class="col-md-3">
            <div class="form-group">
              <label>Status</label>
              <div class="form-control-plaintext">
                @if ($user->status=="Activo")
                  <span class="badge badge-success">{{ $user->status }}</span>
                @else
                  <span class="badge badge-danger">{{ $user->status }}</span>
                @endif
              </div>
            </div>
          </div>
          <div class="col-md-3">
            <div class="form-group">
              <label>Fecha de registro</label>
              <div class="form-control-plaintext">{{ date('d/m/Y - H:i:s', strtotime($user->created_at)) }}</div>
            </div>
          </div>
        </div><hr>
        <div class="row">
          <div class="col-md-12">
            <p>Roles asignados</p>
            @forelse($user->roles as $role)
              <span class="badge rounded-pill bg-dark text-white">{{ $role->name }}</span>
            @empty
              <span class="badge badge-danger bg-danger">No posee roles asignados.</span>
            @endforelse            
          </div>
        </div>
      </div>
    </div>
    <!-- END Dynamic Table Full -->
  </div>
@endsection
