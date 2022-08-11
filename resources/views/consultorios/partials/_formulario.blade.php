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
      @if($btnText=="Guardar")
      <div class="col-md-4">
        <div class="form-group">
          <label class="form-label" for="empresa_id">Empresa <b style="color:red;">*</b></label>
          <select name="empresa_id" id="empresa_id" class="js-select2 form-control"></select>
        </div>
      </div>
      @endif
      <div class="col-md-@if($btnText=="Guardar") col-md-4 @else col-md-6 @endif">
        <div class="form-group">
          <label class="form-label" for="nombre">Nombre <b style="color:red;">*</b></label>
          <input type="text" class="form-control" name="nombre" id="nombre" placeholder="Nombre" value="{{ old('nombre', $consultorio->nombre) }}">
        </div>
      </div>
      <div class="@if($btnText=="Guardar") col-md-4 @else col-md-6 @endif">
        <div class="form-group">
          <label class="form-label" for="telefono">Teléfono <b style="color:red;">*</b></label>
          <input type="text" class="form-control" name="telefono" id="telefono" placeholder="Teléfono" value="{{ old('telefono', $consultorio->telefono) }}">
        </div>
      </div>
    </div>
    <div class="row mb-4">
      <div class="col-md-12">
        <div class="form-group">
          <label class="form-label" for="direccion">Dirección <b style="color:red;">*</b></label>
          <textarea class="form-control" name="direccion" id="direccion" placeholder="Dirección" style="resize: none;">{{ old('direccion', $consultorio->direccion) }}</textarea>
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