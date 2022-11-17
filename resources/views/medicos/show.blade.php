@extends('layouts.app')
@section('title', __('Ver médico'))
@section('css')
  <!-- Page JS Plugins CSS -->
  <link rel="stylesheet" href="{{ asset('js/plugins/datatables/dataTables.bootstrap4.css') }}">
@endsection

@section('content')
  <!-- Page Content -->
  <div class="content">
    <nav class="breadcrumb push bg-body-extra-light rounded-pill px-4 py-2">
      <a class="breadcrumb-item" href="javascript:void(0)">Médico</a>
      <span class="breadcrumb-item active">Ver</span>
    </nav>
    <!-- Dynamic Table Full -->
    <div class="block">
      <div class="block-header block-header-default">
        <h3 class="block-title"><i class="fa fa-user-doctor"></i> Ver médico</h3>
        <a href="{{ route('medicos.index') }}" class="btn btn-primary btn-sm" title="Regresar al listado"><i class="fa fa-arrow-left"></i> Regresar</a>
      </div>
      <div class="block-content block-content-full">
        <div class="row mb-4">
          <div class="col-md-3">
            <div class="form-group">
              <label class="fw-bold">Empresa</label>
              <div class="form-control-plaintext">{{ empty($medico->user->empresa->nombre)?'No posee':$medico->user->empresa->nombre }}</div>
            </div>
          </div>
          <div class="col-md-3">
            <div class="form-group">
              <label class="fw-bold">Tipo de usuario</label>
              <div class="form-control-plaintext">{{ $medico->user->tipo_usuario->nombre }}</div>
            </div>
          </div>
          <div class="col-md-3">
            <div class="form-group">
              <label class="fw-bold">Nombre</label>
              <div class="form-control-plaintext">{{ $medico->persona->nombre }}</div>
            </div>
          </div>
          <div class="col-md-3">
            <div class="form-group">
              <label class="fw-bold">Apellido</label>
              <div class="form-control-plaintext">{{ $medico->persona->apellido }}</div>
            </div>
          </div>
        </div>
        <div class="row mb-4">
          <div class="col-md-3">
            <div class="form-group">
              <label class="fw-bold">Tipo de documento</label>
              <div class="form-control-plaintext">{{ $medico->persona->tipo_documento->nombre }}</div>
            </div>
          </div>
          <div class="col-md-3">
            <div class="form-group">
              <label class="fw-bold">Nro. identificación</label>
              <div class="form-control-plaintext">{{ $medico->persona->numero_identificacion }}</div>
            </div>
          </div>
          <div class="col-md-3">
            <div class="form-group">
              <label class="fw-bold">Email</label>
              <div class="form-control-plaintext">{{ $medico->user->email }}</div>
            </div>
          </div>
          <div class="col-md-3">
            <div class="form-group">
              <label class="fw-bold">Nombre de usuario</label>
              <div class="form-control-plaintext">{{ $medico->user->nombre_usuario }}</div>
            </div>
          </div>
        </div>
        <div class="row mb-4">
          <div class="col-md-3">
            <div class="form-group">
              <label class="fw-bold">Fecha de nacimiento</label>
              <div class="form-control-plaintext">{{ date('d/m/Y', strtotime($medico->persona->fecha_nacimiento)) }}</div>
            </div>
          </div>
          <div class="col-md-3">
            <div class="form-group">
              <label class="fw-bold">Edad</label>
              <div class="form-control-plaintext">{{ calcularEdad($medico->persona->fecha_nacimiento) }}</div>
            </div>
          </div>
          <div class="col-md-3">
            <div class="form-group">
              <label class="fw-bold">Status</label>
              <div class="form-control-plaintext">
                @if ($medico->user->status=="Activo")
                  <span class="badge bg-success">{{ $medico->user->status }}</span>
                @else
                  <span class="badge bg-success">{{ $medico->user->status }}</span>
                @endif
              </div>
            </div>
          </div>
          <div class="col-md-3">
            <div class="form-group">
              <label class="fw-bold">Fecha de registro</label>
              <div class="form-control-plaintext">{{ date('d/m/Y - H:i:s', strtotime($medico->user->created_at)) }}</div>
            </div>
          </div>
        </div><hr>
        <div class="row mb-4">
          <div class="col-md-6 border-start border-5 border-primary">
            <p class="fw-bold">Especialidades</p>
            @forelse($medico->especialidades as $especialidad)
              <span class="badge rounded-pill bg-dark text-white">{{ $especialidad->especialidad }}</span>
            @empty
              <span class="badge badge-danger bg-danger">No posee especialidades asignadas.</span>
            @endforelse
          </div>
          <div class="col-md-6 border-start border-5 border-primary">
            <p class="fw-bold">Roles asignados</p>
            @forelse($medico->user->roles as $role)
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
