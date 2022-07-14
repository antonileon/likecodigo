@csrf
<p class="text-center">Todos los campos con <b style="color:red;">*</b> son obligatorio.</p>
<div class="col-md-12">
  <div class="row">
    <div class="col-md-6">
      <div class="form-group">
        {!! Form::label('description','Descripción') !!}
        {!! Form::text('description',null,['class'=>'form-control','placeholder'=>'Descripción']) !!}
      </div>
      @error('description')
        <div class="alert alert-danger">{{ $message }}</div>
      @enderror
    </div>
    <div class="col-md-6">
      <div class="form-group">
        {!! Form::label('name','Nombre') !!}
        {!! Form::text('name',null,['class'=>'form-control','placeholder'=>'Nombre']) !!}
      </div>
      @error('name')
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