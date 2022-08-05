<div class="block-content block-content-full">
  @csrf
  <p class="text-center">Todos los campos con <b style="color:red;">*</b> son obligatorio.</p>
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
          <label class="form-label" for="nombre">Nombre <b style="color:red;">*</b></label>
          <input type="text" class="form-control form-control-sm" name="nombre" id="nombre" placeholder="Nombre" value="{{ old('nombre', $empresa->nombre) }}">
        </div>
        @error('nombre')
          <div class="invalid-feedback">{{ $message }}</div>
        @enderror
      </div>
      <div class="col-md-4">
        <div class="form-group">
          <label class="form-label" for="numero_identificacion">Número de identificación <b style="color:red;">*</b></label>
          <input type="text" class="form-control form-control-sm" name="numero_identificacion" id="numero_identificacion" placeholder="Número de identificación" value="{{ old('numero_identificacion', $empresa->numero_identificacion) }}">
        </div>
      </div>
      <div class="col-md-4">
        <div class="form-group">
          <label class="form-label" for="email">Email <b style="color:red;">*</b></label>
          <input type="email" class="form-control form-control-sm" name="email" id="email" placeholder="Email" value="{{ old('email', $empresa->email) }}">
        </div>
      </div>
    </div>
    <div class="row mb-4">
      <div class="col-md-4">
        <div class="form-group">
          <label class="form-label" for="telefono">Teléfono <b style="color:red;">*</b></label>
          <input type="text" class="form-control form-control-sm" name="telefono" id="telefono" placeholder="Teléfono" value="{{ old('telefono', $empresa->telefono) }}">
        </div>
      </div>
      <div class="col-md-4">
        <div class="form-group">
          <label class="form-label" for="status">Status <b style="color:red;">*</b></label>
          <select name="status" id="status" class="form-select form-select-sm" data-placeholder="Choose one.." style="width: 100%;">
            <option value="Activo" {{ old('status' , $empresa->status)=='Activo'? 'selected' : '' }}>Activo</option>
            <option value="Inactivo" {{ old('status' , $empresa->status)=='Inactivo'? 'selected' : '' }}>Inactivo</option>
          </select>
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