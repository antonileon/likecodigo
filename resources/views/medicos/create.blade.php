@extends('layouts.app')
@section('title', __('Registrar médico'))
@section('css')
@endsection

@section('content')
  <!-- Page Content -->
  <div class="content">
    <nav class="breadcrumb push bg-body-extra-light rounded-pill px-4 py-2">
      <a class="breadcrumb-item" href="javascript:void(0)">Medicos</a>
      <span class="breadcrumb-item active">Registrar</span>
    </nav>
    <!-- Dynamic Table Full -->
    <div class="block block-rounded">
      <div class="block-header block-header-default">
        <h3 class="block-title"><i class="fa fa-user-doctor"></i> Registrar médico</h3>
        <a href="{{ route('medicos.index') }}" class="btn btn-primary btn-sm" title="Regresar al listado"><i class="fa fa-arrow-left"></i> Regresar</a>
      </div>
      <form action="{{ route('medicos.store') }}" method="POST" enctype="multipart/form-data" autocomplete="off" data-parsley-validate>
        <div class="block-content block-content-full">
          @csrf
          <p class="text-center fw-bold">Todos los campos con <b style="color:red;">*</b> son obligatorio.</p>
          @if ($errors->any())
            <div class="alert alert-danger">
              <ul>
                @foreach ($errors->all() as $error)
                  <li>{{ $error }}</li>
                @endforeach
              </ul>
            </div>
          @endif
          <div class="col-md-12">
            <div class="row mb-4">
              <div class="col-md-4">
                <div class="form-group">
                  <label class="form-label" for="tipo_documento_id">Tipo documento <b style="color:red;">*</b></label>
                  <select name="tipo_documento_id" id="tipo_documento_id" class="form-select js-select2" data-placeholder="Eliga una opción..">
                    @foreach($tipoDocumentos as $tipoDocumento)
                      <option></option>
                      <option value="{{ $tipoDocumento->id }}">{{ $tipoDocumento->nombre }}</option>
                    @endforeach
                  </select>
                </div>
              </div>
              <div class="col-md-4">
                <div class="form-group">
                  <label class="form-label" for="numero_identificacion">Número de identificación <b style="color:red;">*</b></label>
                  <input type="text" class="form-control" name="numero_identificacion" id="numero_identificacion" placeholder="Número de identificación" value="{{ old('numero_identificacion', empty($medico->persona->numero_identificacion)?'':$medico->persona->numero_identificacion) }}" required>
                </div>
              </div>
              <div class="col-md-4">
                <div class="form-group">
                  <label class="form-label" for="nombre">Nombre <b style="color:red;">*</b></label>
                  <input type="text" class="form-control" name="nombre" id="nombre" placeholder="Nombre" value="{{ old('nombre', empty($medico->persona->nombre)?'':$medico->persona->nombre) }}" required>
                </div>
              </div>
            </div>
            <div class="row mb-4">
              <div class="col-md-4">
                <div class="form-group">
                  <label class="form-label" for="apellido">Apellido <b style="color:red;">*</b></label>
                  <input type="text" class="form-control" name="apellido" id="apellido" placeholder="Apellido" value="{{ old('apellido', empty($medico->persona->apellido)?'':$medico->persona->apellido) }}" required>
                </div>
              </div>
              <div class="col-md-4">
                <div class="form-group">
                  <label class="form-label" for="fecha_nacimiento">Fecha de nacimiento <b style="color:red;">*</b></label>
                  <input type="date" class="form-control" name="fecha_nacimiento" id="fecha_nacimiento" value="{{ old('fecha_nacimiento', empty($medico->persona->fecha_nacimiento)?'':$medico->persona->fecha_nacimiento) }}" max="{{ date('Y-m-d') }}" required>
                </div>
              </div>
              <div class="col-md-4">
                <div class="form-group">
                  <label class="form-label" for="telefono">Teléfono <b style="color:red;">*</b></label>
                  <input type="text" class="form-control" name="telefono" id="telefono" placeholder="Teléfono" value="{{ old('telefono', empty($medico->persona->telefono)?'':$medico->persona->telefono) }}" required>
                </div>
              </div>
            </div>
            <div class="row mb-4">
              <div class="col-md-4">
                <div class="form-group">
                  <label class="form-label" for="email">Email <b style="color:red;">*</b></label>
                  <input type="email" class="form-control" name="email" id="email" placeholder="Email" value="{{ old('email', empty($medico->user->email)?'':$medico->user->email) }}" required>
                </div>
              </div>
              <div class="col-md-4">
                <div class="form-group">
                  <label class="form-label" for="password">Contraseña <b style="color:red;">*</b></label>
                  <input type="password" class="form-control" name="password" id="password" placeholder="Contraseña" required>
                </div>
              </div>
              <div class="col-md-4">
                <div class="form-group">
                  <label class="form-label" for="repita_contraseña">Repita contraseña <b style="color:red;">*</b></label>
                  <input type="password" class="form-control" name="repita_contraseña" id="repita_contraseña" placeholder="Repita contraseña" required data-parsley-equalto="#password">
                </div>
              </div>
              
            </div>
          </div>
        </div>
        <div class="block-content block-content-full block-content-sm bg-body-light text-end">
          <button type="reset" class="btn btn-alt-secondary">
            <i class="fa fa-sync-alt opacity-50 me-1"></i> Limpiar
          </button>
          <button type="submit" class="btn btn-alt-primary" title="Guardar">
            <i class="fa fa-check opacity-50 me-1"></i> Guardar
          </button>
        </div>
      </form>
    </div>
    <!-- END Dynamic Table Full -->
  </div>
@endsection
