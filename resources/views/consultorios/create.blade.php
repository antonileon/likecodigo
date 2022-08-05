@extends('layouts.app')

@section('css')
  <!-- Page JS Plugins CSS -->
  <link rel="stylesheet" href="{{ asset('js/plugins/datatables/dataTables.bootstrap4.css') }}">
@endsection

@section('content')
  <!-- Page Content -->
  <div class="content">
    <nav class="breadcrumb bg-white push">
      <a class="breadcrumb-item" href="javascript:void(0)">Consultorio</a>
      <span class="breadcrumb-item active">Registrar</span>
    </nav>
    <!-- Dynamic Table Full -->
    <div class="block">
      <div class="block-header block-header-default">
        <h3 class="block-title"><i class="fa fa-hospital"></i> Registrar consultorio</h3>
        <a href="{{ route('consultorios.index') }}" class="btn btn-primary btn-sm" title="Regresar al listado"><i class="fa fa-arrow-left"></i> Regresar</a>
      </div>
      <div class="block-content block-content-full">
        <form action="{{ route('consultorios.store') }}" method="POST" enctype="multipart/form-data" autocomplete="off">
          @include('consultorios._formulario', ['btnText' => 'Guardar'])
        </form>
      </div>
    </div>
    <!-- END Dynamic Table Full -->
  </div>
@endsection
@section('scripts')
<script type="text/javascript">
  $(document).ready(function() {
    $("#empresa_id").select2({
      placeholder: "Busque una empresa...",
      minimumInputLength: 3,
      ajax: {
        url: "{{ url('consultorios/buscar-empresas') }}",
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