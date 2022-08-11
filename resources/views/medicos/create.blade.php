@extends('layouts.app')
@section('title', __('Registrar médico'))
@section('css')
@endsection

@section('content')
  <!-- Page Content -->
  <div class="content">
    <nav class="breadcrumb push bg-body-extra-light rounded-pill px-4 py-2">
      <a class="breadcrumb-item" href="javascript:void(0)">Medicos</a>
      <span class="breadcrumb-item active">Registrar</span>
    </nav>
    <!-- Dynamic Table Full -->
    <div class="block block-rounded">
      <div class="block-header block-header-default">
        <h3 class="block-title"><i class="fa fa-user-doctor"></i> Registrar médico</h3>
        <a href="{{ route('medicos.index') }}" class="btn btn-primary btn-sm" title="Regresar al listado"><i class="fa fa-arrow-left"></i> Regresar</a>
      </div>
      <form action="{{ route('medicos.store') }}" method="POST" enctype="multipart/form-data" autocomplete="off" data-parsley-validate>
        @include('medicos.partials._formulario', ['btnText' => 'Guardar'])
      </form>
    </div>
    <!-- END Dynamic Table Full -->
  </div>
@endsection
