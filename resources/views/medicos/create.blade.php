@extends('layouts.app')
@section('title', __('Registrar médico'))
@section('css')
@endsection

@section('content')
  <!-- Page Content -->
  <div class="content">
    <nav class="breadcrumb bg-white push">
      <a class="breadcrumb-item" href="javascript:void(0)">Medicos</a>
      <span class="breadcrumb-item active">Registrar</span>
    </nav>
    <!-- Dynamic Table Full -->
    <div class="block">
      <div class="block-header block-header-default">
        <h3 class="block-title"><i class="fa fa-building"></i> Registrar médico</h3>
        <a href="{{ route('medicos.index') }}" class="btn btn-primary btn-sm" title="Regresar al listado"><i class="fa fa-arrow-left"></i> Regresar</a>
      </div>
      <div class="block-content block-content-full">
        <form action="{{ route('medicos.store') }}" method="POST" enctype="multipart/form-data" autocomplete="off">
          @include('medicos.partials._formulario', ['btnText' => 'Guardar'])
        </form>
      </div>
    </div>
    <!-- END Dynamic Table Full -->
  </div>
@endsection
