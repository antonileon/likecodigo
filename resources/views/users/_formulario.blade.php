@csrf
<p class="text-center">Todos los campos con <b style="color:red;">*</b> son obligatorio.</p>
<div class="col-md-12">
  <div class="row">
    <div class="col-md-4">
      <div class="form-group">
        <label for="nombre">Nombre <b style="color:red;">*</b></label>
        <input type="text" class="form-control" name="nombre" id="nombre" placeholder="Nombre" value="{{ old('nombre', $user->nombre) }}">
      </div>
      @error('nombre')
        <div class="alert alert-danger">{{ $message }}</div>
      @enderror
    </div>
    <div class="col-md-4">
      <div class="form-group">
        <label for="apellido">Apellido <b style="color:red;">*</b></label>
        <input type="text" class="form-control" name="apellido" id="apellido" placeholder="Apellido" value="{{ old('apellido', $user->apellido) }}">
      </div>
      @error('apellido')
        <div class="alert alert-danger">{{ $message }}</div>
      @enderror
    </div>
    <div class="col-md-4">
      <div class="form-group">
        <label for="nombre_usuario">Nombre de usuario <b style="color:red;">*</b></label>
        <input type="text" class="form-control" name="nombre_usuario" id="nombre_usuario" placeholder="Nombre de usuario" value="{{ old('nombre_usuario', $user->nombre_usuario) }}">
      </div>
      @error('nombre_usuario')
        <div class="alert alert-danger">{{ $message }}</div>
      @enderror
    </div>
  </div>
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
        <label for="numero_documento">N° documento <b style="color:red;">*</b></label>
        <input type="text" class="form-control" name="numero_documento" id="numero_documento" placeholder="N° documento" value="{{ old('numero_documento', $user->numero_documento) }}">
      </div>
      @error('numero_documento')
        <div class="alert alert-danger">{{ $message }}</div>
      @enderror
    </div>
    <div class="col-md-4">
      <div class="form-group">
        <label for="telefono">Teléfono <b style="color:red;">*</b></label>
        <input type="text" class="form-control" name="telefono" id="telefono" placeholder="Teléfono" value="{{ old('telefono', $user->telefono) }}">
      </div>
      @error('telefono')
        <div class="alert alert-danger">{{ $message }}</div>
      @enderror
    </div>
  </div>
  <div class="row">
    <div class="col-md-4">
      <div class="form-group">
        <label for="tipo_usuario_id">Tipo de usuario <b style="color:red;">*</b></label>
        <select name="tipo_usuario_id" id="tipo_usuario_id" class="form-control">
          @foreach($tipoUsuarios as $tipoUsuario)
            <option value="{{ $tipoUsuario->id }}">{{ $tipoUsuario->nombre }}</option>
          @endforeach
        </select>
      </div>
      @error('tipo_usuario_id')
        <div class="alert alert-danger">{{ $message }}</div>
      @enderror
    </div>
    <div class="col-md-4">
      <div class="form-group">
        <label for="email">Email <b style="color:red;">*</b></label>
        <input type="email" class="form-control" name="email" id="email" placeholder="Email" value="{{ old('email', $user->email) }}">
      </div>
      @error('email')
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