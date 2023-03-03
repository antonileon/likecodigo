@extends('layouts.app')
@section('title', __('Registrar cita'))
@section('css')
@endsection

@section('content')
  <!-- Page Content -->
  <div class="content">
    <nav class="breadcrumb push bg-body-extra-light rounded-pill px-4 py-2">
      <a class="breadcrumb-item" href="javascript:void(0)">Citas</a>
      <span class="breadcrumb-item active">Registrar</span>
    </nav>
    <!-- Dynamic Table Full -->
    <div class="block">
      <div class="block-header block-header-default">
        <h3 class="block-title"><i class="fa fa-clock"></i> Registrar cita</h3>
        <a href="{{ route('citas.index') }}" class="btn btn-primary btn-sm" title="Regresar al listado"><i class="fa fa-arrow-left"></i> Regresar</a>
      </div>
      <form action="{{ route('citas.store') }}" method="POST" enctype="multipart/form-data" autocomplete="off">
        @include('citas.partials._formulario', ['btnText' => 'Guardar'])
      </form>
    </div>
    <!-- END Dynamic Table Full -->
  </div>
@endsection
@section('scripts')
<script>
$(document).ready( function () {
  $("#paciente_id").select2({
    placeholder: "Busque un paciente...",
    minimumInputLength: 3,
    ajax: {
      url: "{{ url('citas/buscar-pacientes') }}",
      type: "POST",
      delay: 250,
      dataType: 'json',
      data: function(params) {
        return {
          query: params.term, // search term
          "_token": "{{ csrf_token() }}",
        };
      },
      processResults: function(response) {
        return { results: response };
      },
      cache: true
    }
  });
});
</script>
@endsection