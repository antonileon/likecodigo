@extends('layouts.app')
@section('title', __('Editar médico'))
@section('css')
@endsection

@section('content')
  <!-- Page Content -->
  <div class="content">
    <nav class="breadcrumb bg-white push">
      <a class="breadcrumb-item" href="javascript:void(0)">Médicos</a>
      <span class="breadcrumb-item active">Editar</span>
    </nav>
    <!-- Dynamic Table Full -->
    <div class="block">
      <div class="block-header block-header-default">
        <h3 class="block-title"><i class="fa fa-building"></i> Editar médico</h3>
        <a href="{{ route('medicos.index') }}" class="btn btn-primary btn-sm" title="Regresar al listado"><i class="fa fa-arrow-left"></i> Regresar</a>
      </div>
      <div class="block-content block-content-full">
        <form action="{{ route('medicos.update', $medico) }}" method="POST" enctype="multipart/form-data" autocomplete="off">
          @method('PUT')
          @include('medicos.partials._formulario', ['btnText' => 'Modificar'])
        </form>
      </div>
    </div>
    <!-- END Dynamic Table Full -->
  </div>
@endsection
