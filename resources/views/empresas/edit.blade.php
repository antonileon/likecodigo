@extends('layouts.app')
@section('title', __('Editar empresa'))
@section('css')
@endsection

@section('content')
  <!-- Page Content -->
  <div class="content">
    <nav class="breadcrumb push bg-body-extra-light rounded-pill px-4 py-2">
      <a class="breadcrumb-item" href="javascript:void(0)">Empresas</a>
      <span class="breadcrumb-item active">Editar</span>
    </nav>
    <!-- Dynamic Table Full -->
    <div class="block block-rounded">
      <div class="block-header block-header-default">
        <h3 class="block-title"><i class="fa fa-building"></i> Editar empresa</h3>
        <a href="{{ route('empresas.index') }}" class="btn btn-primary btn-sm" title="Regresar al listado"><i class="fa fa-arrow-left"></i> Regresar</a>
      </div>
      <form action="{{ route('empresas.update', $empresa) }}" method="POST" enctype="multipart/form-data" autocomplete="off">
        @method('PUT')
        @include('empresas.partials._formulario', ['btnText' => 'Guardar'])
      </form>
    </div>
    <!-- END Dynamic Table Full -->
  </div>
@endsection
