@csrf
<p class="text-center">Todos los campos con <b style="color:red;">*</b> son obligatorio.</p>
<div class="col-md-12">
  <div class="row">
    <div class="col-md-12">
      <div class="form-group">
        {!! Form::label('name','Nombre') !!}
        {!! Form::text('name',null,['class'=>'form-control','placeholder'=>'Nombre']) !!}
      </div>
      @error('name')
        <div class="alert alert-danger">{{ $message }}</div>
      @enderror
    </div>
  </div>
  <h4>Lista de permisos</h4>
  <div class="row">
    @foreach ($permissions as $id => $permission)
    <div class="col-md-3">
      <label class="css-control css-control-sm css-control-success css-switch">
        <input type="checkbox" class="css-control-input" name="permissions[]" value="{{ $id }}">
        <span class="css-control-indicator"></span> {{ $permission }}
      </label>
    </div>
    @endforeach
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