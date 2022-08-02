@csrf
<p class="text-center">Todos los campos con <b style="color:red;">*</b> son obligatorio.</p>
<div class="col-md-12">
  <div class="row">
    <div class="col-md-4">
      <div class="form-group">
        <label for="tipo_documento_id">Tipo documento <b style="color:red;">*</b></label>
        <select name="tipo_documento_id" id="tipo_documento_id" class="form-control">
          @foreach($tipoDocumentos as $tipoDocumento)
            <option value="{{ $tipoDocumento->id }}">{{ $tipoDocumento->nombre }}</option>
          @endforeach
        </select>
      </div>
      @error('tipo_documento_id')
        <div class="alert alert-danger">{{ $message }}</div>
      @enderror
    </div>
    <div class="col-md-4">
      <div class="form-group">
        <label for="numero_identificacion">Número de identificación <b style="color:red;">*</b></label>
        <input type="text" class="form-control" name="numero_identificacion" id="numero_identificacion" placeholder="Número de identificación" value="{{ old('numero_identificacion', empty($medico->persona->numero_identificacion)?'':$medico->persona->numero_identificacion) }}">
      </div>
      @error('numero_identificacion')
        <div class="alert alert-danger">{{ $message }}</div>
      @enderror
    </div>
    <div class="col-md-4">
      <div class="form-group">
        <label for="nombre">Nombre <b style="color:red;">*</b></label>
        <input type="text" class="form-control" name="nombre" id="nombre" placeholder="Nombre" value="{{ old('nombre', empty($medico->persona->nombre)?'':$medico->persona->nombre) }}">
      </div>
      @error('nombre')
        <div class="alert alert-danger">{{ $message }}</div>
      @enderror
    </div>
  </div>
  <div class="row">
    <div class="col-md-4">
      <div class="form-group">
        <label for="apellido">Apellido <b style="color:red;">*</b></label>
        <input type="text" class="form-control" name="apellido" id="apellido" placeholder="Apellido" value="{{ old('apellido', empty($medico->persona->apellido)?'':$medico->persona->apellido) }}">
      </div>
      @error('apellido')
        <div class="alert alert-danger">{{ $message }}</div>
      @enderror
    </div>
    <div class="col-md-4">
      <div class="form-group">
        <label for="fecha_nacimiento">Fecha de nacimiento <b style="color:red;">*</b></label>
        <input type="date" class="form-control" name="fecha_nacimiento" id="fecha_nacimiento" value="{{ old('fecha_nacimiento', empty($medico->persona->fecha_nacimiento)?'':$medico->persona->fecha_nacimiento) }}" max="{{ date('Y-m-d') }}">
      </div>
      @error('fecha_nacimiento')
        <div class="alert alert-danger">{{ $message }}</div>
      @enderror
    </div>
    <div class="col-md-4">
      <div class="form-group">
        <label for="telefono">Teléfono <b style="color:red;">*</b></label>
        <input type="text" class="form-control" name="telefono" id="telefono" placeholder="Teléfono" value="{{ old('telefono', empty($medico->persona->telefono)?'':$medico->persona->telefono) }}">
      </div>
      @error('telefono')
        <div class="alert alert-danger">{{ $message }}</div>
      @enderror
    </div>
  </div>
  <div class="row">
    <div class="col-md-4">
      <div class="form-group">
        <label for="email">Email <b style="color:red;">*</b></label>
        <input type="email" class="form-control" name="email" id="email" placeholder="Email" value="{{ old('email', empty($medico->user->email)?'':$medico->user->email) }}">
      </div>
      @error('email')
        <div class="alert alert-danger">{{ $message }}</div>
      @enderror
    </div>
    <div class="col-md-4">
      <div class="form-group">
        <label for="password">Contraseña <b style="color:red;">*</b></label>
        <input type="password" class="form-control" name="password" id="password" placeholder="Contraseña">
      </div>
      @error('password')
        <div class="alert alert-danger">{{ $message }}</div>
      @enderror
    </div>
    <div class="col-md-4">
      <div class="form-group">
        <label for="repita_contraseña">Repita contraseña <b style="color:red;">*</b></label>
        <input type="password" class="form-control" name="repita_contraseña" id="repita_contraseña" placeholder="Repita contraseña">
      </div>
      @error('repita_contraseña')
        <div class="alert alert-danger">{{ $message }}</div>
      @enderror
    </div>
    
  </div>
</div>
<hr>
<div class="row justify-content-center text-center">
  <div class="col-12">
    <div class="form-group">
      <button type="submit" class="btn btn-alt-primary" title="{{ $btnText }}"><i class="fa fa-edit"></i> {{ $btnText }}</button>
    </div>
  </div>
</div>