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
              <option value="{{ $tipoDocumento->id }}" {{ old('tipo_documento_id' , $paciente->persona->tipo_documento_id)==$tipoDocumento->id? 'selected' : '' }}>{{ $tipoDocumento->nombre }}</option>
            @endforeach
          </select>
        </div>
      </div>
      <div class="col-md-4">
        <div class="form-group">
          <label class="form-label" for="numero_identificacion">Número de identificación <b style="color:red;">*</b></label>
          <input type="text" class="form-control" name="numero_identificacion" id="numero_identificacion" placeholder="Número de identificación" value="{{ old('numero_identificacion', empty($paciente->persona->numero_identificacion)?'':$paciente->persona->numero_identificacion) }}" required>
        </div>
      </div>
      <div class="col-md-4">
        <div class="form-group">
          <label class="form-label" for="nombre">Nombre <b style="color:red;">*</b></label>
          <input type="text" class="form-control" name="nombre" id="nombre" placeholder="Nombre" value="{{ old('nombre', empty($paciente->persona->nombre)?'':$paciente->persona->nombre) }}" required>
        </div>
      </div>
    </div>
    <div class="row mb-4">
      <div class="col-md-4">
        <div class="form-group">
          <label class="form-label" for="apellido">Apellido <b style="color:red;">*</b></label>
          <input type="text" class="form-control" name="apellido" id="apellido" placeholder="Apellido" value="{{ old('apellido', empty($paciente->persona->apellido)?'':$paciente->persona->apellido) }}" required>
        </div>
      </div>
      <div class="col-md-4">
        <div class="form-group">
          <label class="form-label" for="fecha_nacimiento">Fecha de nacimiento <b style="color:red;">*</b></label>
          <input type="date" class="form-control" name="fecha_nacimiento" id="fecha_nacimiento" value="{{ old('fecha_nacimiento', empty($paciente->persona->fecha_nacimiento)?'':$paciente->persona->fecha_nacimiento) }}" max="{{ date('Y-m-d') }}" required>
        </div>
      </div>
      <div class="col-md-4">
        <div class="form-group">
          <label class="form-label" for="telefono">Teléfono <b style="color:red;">*</b></label>
          <input type="text" class="form-control" name="telefono" id="telefono" placeholder="Teléfono" value="{{ old('telefono', empty($paciente->persona->telefono)?'':$paciente->persona->telefono) }}" required>
        </div>
      </div>
    </div>
    <div class="row mb-4">
      <div class="col-md-4">
        <div class="form-group">
          <label class="form-label" for="email">Email <b style="color:red;">*</b></label>
          <input type="email" class="form-control" name="email" id="email" placeholder="Email" value="{{ old('email', empty($paciente->user->email)?'':$paciente->user->email) }}" required>
        </div>
      </div>
    </div>
  </div>
</div>
<div class="block-content block-content-full block-content-sm bg-body-light text-end">
  <button type="reset" class="btn btn-alt-secondary">
    <i class="fa fa-sync-alt opacity-50 me-1"></i> Limpiar
  </button>
  <button type="submit" class="btn btn-alt-primary" title="{{ $btnText }}">
    <i class="fa fa-check opacity-50 me-1"></i> {{ $btnText }}
  </button>
</div>