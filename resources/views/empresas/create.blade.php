@extends('layouts.app')

@section('css')
@endsection

@section('content')
  <!-- Page Content -->
  <div class="content">
    <nav class="breadcrumb bg-white push">
      <a class="breadcrumb-item" href="javascript:void(0)">Empresas</a>
      <span class="breadcrumb-item active">Registrar</span>
    </nav>
    <!-- Dynamic Table Full -->
    <div class="block">
      <div class="block-header block-header-default">
        <h3 class="block-title"><i class="fa fa-building"></i> Registrar empresa</h3>
        <a href="{{ route('empresas.index') }}" class="btn btn-primary btn-sm" title="Regresar al listado"><i class="fa fa-arrow-left"></i> Regresar</a>
      </div>
      <div class="block-content block-content-full">
        <form action="{{ route('empresas.store') }}" method="POST" enctype="multipart/form-data" autocomplete="off">
          @include('empresas.partials._formulario', ['btnText' => 'Guardar'])
        </form>
      </div>
    </div>
    <!-- END Dynamic Table Full -->
  </div>
@endsection
