<div class="block-content block-content-full">
  @csrf
  <p class="text-center">Todos los campos con <b style="color:red;">*</b> son obligatorio.</p>
  <div class="row mb-4">
    <div class="col-md-12">
      <div class="form-group">
        {!! Form::label('name','Nombre',['class'=>'form-label']) !!}
        {!! Form::text('name',null,['class'=>'form-control mb-1','placeholder'=>'Nombre']) !!}
      </div>
      @error('name')
        <div class="alert alert-danger">{{ $message }}</div>
      @enderror
    </div>
  </div>
  <div class="row" style="font-size:14px;">
    <h4>Lista de permisos</h4>
    @foreach ($permissions as $id => $permission)
    <div class="col-md-3">
      <div class="form-check form-switch">
        <input class="form-check-input" type="checkbox" value="{{ $id }}" id="{{ $id }}" name="permissions[]">
        <label class="form-check-label" for="{{ $id }}">{{ $permission }}</label>
      </div>
    </div>
    @endforeach
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