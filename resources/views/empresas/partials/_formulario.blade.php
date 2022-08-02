@csrf
<p class="text-center">Todos los campos con <b style="color:red;">*</b> son obligatorio.</p>
<div class="col-md-12">
  <div class="row">
    <div class="col-md-4">
      <div class="form-group">
        <label for="nombre">Nombre <b style="color:red;">*</b></label>
        <input type="text" class="form-control" name="nombre" id="nombre" placeholder="Nombre" value="{{ old('nombre', $empresa->nombre) }}">
      </div>
      @error('nombre')
        <div class="alert alert-danger">{{ $message }}</div>
      @enderror
    </div>
    <div class="col-md-4">
      <div class="form-group">
        <label for="numero_identificacion">Número de identificación <b style="color:red;">*</b></label>
        <input type="text" class="form-control" name="numero_identificacion" id="numero_identificacion" placeholder="Número de identificación" value="{{ old('numero_identificacion', $empresa->numero_identificacion) }}">
      </div>
      @error('numero_identificacion')
        <div class="alert alert-danger">{{ $message }}</div>
      @enderror
    </div>
    <div class="col-md-4">
      <div class="form-group">
        <label for="email">Email <b style="color:red;">*</b></label>
        <input type="email" class="form-control" name="email" id="email" placeholder="Email" value="{{ old('email', $empresa->email) }}">
      </div>
      @error('email')
        <div class="alert alert-danger">{{ $message }}</div>
      @enderror
    </div>
  </div>
  <div class="row">
    <div class="col-md-4">
      <div class="form-group">
        <label for="telefono">Teléfono <b style="color:red;">*</b></label>
        <input type="text" class="form-control" name="telefono" id="telefono" placeholder="Teléfono" value="{{ old('telefono', $empresa->telefono) }}">
      </div>
      @error('telefono')
        <div class="alert alert-danger">{{ $message }}</div>
      @enderror
    </div>
    <div class="col-md-4">
      <div class="form-group">
        <label for="status">Status <b style="color:red;">*</b></label>
        <select name="status" id="status" class="form-control">
          <option value="Activo" {{ old('status' , $empresa->status)=='Activo'? 'selected' : '' }}>Activo</option>
          <option value="Inactivo" {{ old('status' , $empresa->status)=='Inactivo'? 'selected' : '' }}>Inactivo</option>
        </select>
      </div>
      @error('status')
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