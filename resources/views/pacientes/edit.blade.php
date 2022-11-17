@extends('layouts.app')
@section('title', __('Editar paciente'))
@section('css')
@endsection

@section('content')
  <!-- Page Content -->
  <div class="content">
    <nav class="breadcrumb push bg-body-extra-light rounded-pill px-4 py-2">
      <a class="breadcrumb-item" href="javascript:void(0)">Paciente</a>
      <span class="breadcrumb-item active">Editar</span>
    </nav>
    <!-- Dynamic Table Full -->
    <div class="block">
      <div class="block-header block-header-default">
        <h3 class="block-title"><i class="nav-main-link-icon fa fa-user-tie"></i> Editar paciente</h3>
        <a href="{{ route('pacientes.index') }}" class="btn btn-primary btn-sm" title="Regresar al listado"><i class="fa fa-arrow-left"></i> Regresar</a>
      </div>
      <div class="block-content block-content-full">
        <form action="{{ route('pacientes.update', $paciente) }}" method="POST" enctype="multipart/form-data" autocomplete="off">
          @method('PUT')
          @include('pacientes.partials._formulario', ['btnText' => 'Modificar'])
        </form>
      </div>
    </div>
    <!-- END Dynamic Table Full -->
  </div>
@endsection
