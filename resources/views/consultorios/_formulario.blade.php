@csrf
<p class="text-center">Todos los campos con <b style="color:red;">*</b> son obligatorio.</p>
<div class="col-md-12">
  <div class="row">
    @if($btnText=="Guardar")
    <div class="col-md-4">
      <div class="form-group">
        <label for="empresa_id">Empresa <b style="color:red;">*</b></label>
        <select name="empresa_id" id="empresa_id" class="js-select2 form-control"></select>
      </div>
    </div>
    @endif
    <div class="col-md-@if($btnText=="Guardar") col-md-4 @else col-md-6 @endif">
      <div class="form-group">
        <label for="nombre">Nombre <b style="color:red;">*</b></label>
        <input type="text" class="form-control" name="nombre" id="nombre" placeholder="Nombre" value="{{ old('nombre', $consultorio->nombre) }}">
      </div>
      @error('nombre')
        <div class="alert alert-danger">{{ $message }}</div>
      @enderror
    </div>
    <div class="@if($btnText=="Guardar") col-md-4 @else col-md-6 @endif">
      <div class="form-group">
        <label for="telefono">Teléfono <b style="color:red;">*</b></label>
        <input type="text" class="form-control" name="telefono" id="telefono" placeholder="Teléfono" value="{{ old('telefono', $consultorio->telefono) }}">
      </div>
      @error('telefono')
        <div class="alert alert-danger">{{ $message }}</div>
      @enderror
    </div>
  </div>
  <div class="row">
    <div class="col-md-12">
      <div class="form-group">
        <label for="direccion">Dirección <b style="color:red;">*</b></label>
        <textarea class="form-control" name="direccion" id="direccion" placeholder="Dirección" style="resize: none;">{{ old('direccion', $consultorio->direccion) }}</textarea>
      </div>
      @error('direccion')
        <div class="alert alert-danger">{{ $message }}</div>
      @enderror
    </div>
  </div>
</div>
<hr>
<div class="row justify-content-center text-center">
  <div class="col-12">
    <div class="form-group">
      <button type="submit" class="btn btn-alt-primary" title="{{$btnText}}"><i class="fa fa-edit"></i> {{$btnText}}</button>
    </div>
  </div>
</div>