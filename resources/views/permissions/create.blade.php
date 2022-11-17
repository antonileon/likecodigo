@extends('layouts.app')

@section('css')
@endsection

@section('content')
  <!-- Page Content -->
  <div class="content">
    <nav class="breadcrumb push bg-body-extra-light rounded-pill px-4 py-2">
      <a class="breadcrumb-item" href="javascript:void(0)">Permisos</a>
      <span class="breadcrumb-item active">Registrar</span>
    </nav>
    <!-- Dynamic Table Full -->
    <div class="block">
      <div class="block-header block-header-default">
        <h3 class="block-title"><i class="fa fa-cogs"></i> Registrar permiso</h3>
        <a href="{{ route('permissions.index') }}" class="btn btn-primary btn-sm" title="Regresar al listado"><i class="fa fa-arrow-left"></i> Regresar</a>
      </div>
      <div class="block-content block-content-full">
        <form action="{{ route('permissions.store') }}" method="POST" enctype="multipart/form-data" autocomplete="off">
          @include('permissions.partials._formulario', ['btnText' => 'Guardar'])
        </form>
      </div>
    </div>
    <!-- END Dynamic Table Full -->
  </div>
@endsection
