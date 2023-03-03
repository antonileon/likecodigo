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
      <div class="col-md-6">
        <div class="form-group">
          <label class="form-label" for="paciente_id">Paciente <b style="color:red;">*</b></label>
          <select class="js-select2 form-select" id="paciente_id" name="paciente_id" style="width: 100%;">
          </select>
        </div>
      </div>
      <div class="col-md-6">
        <div class="form-group">
          <label class="form-label" for="numero_identificacion">Número de identificación <b style="color:red;">*</b></label>
          <input type="text" class="form-control" name="numero_identificacion" id="numero_identificacion" placeholder="Número de identificación" value="">
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