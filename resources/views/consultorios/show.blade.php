@extends('layouts.app')
@section('title', __('Ver consultorio'))
@section('css')
@endsection

@section('content')
  <!-- Page Content -->
  <div class="content">
    <nav class="breadcrumb push bg-body-extra-light rounded-pill px-4 py-2">
      <a class="breadcrumb-item" href="javascript:void(0)">Consultorio</a>
      <span class="breadcrumb-item active">Ver datos</span>
    </nav>
    <div class="row">
      <div class="col-12">
        <div class="block block-rounded">
          <div class="block-header block-header-default">
            <h3 class="block-title"><i class="fa fa-hospital"></i> Datos del consultorio</h3>
            <a href="{{ route('consultorios.index') }}" class="btn btn-primary btn-sm" title="Regresar al listado">
              <i class="fa fa-arrow-left"></i> Regresar
            </a>
          </div>
          <div class="block-content block-content-full">
            <div class="font-size-lg text-black mb-5">{{ $consultorio->nombre }}</div>
            <address>
              {{ $consultorio->direccion }}<br>
              <i class="fa fa-phone mr-5"></i> {{ $consultorio->telefono }}<br>
              {{-- <i class="fa fa-envelope-o mr-5"></i> <a href="javascript:void(0)"></a> --}}
            </address>
            <a class="btn btn-sm btn-warning btn-rounded mr-5 my-5" href="{{ route('consultorios.edit', $consultorio->slug) }}" title="Editar datos del consultorio">
              <i class="fa fa-pencil mr-5"></i> Editar
            </a>                
            <a class="btn btn-sm btn-danger btn-rounded mr-5 my-5" href="javascript:void(0)" title="Eliminar consultorio">
              <i class="fa fa-trash mr-5"></i> Eliminar
            </a>
          </div>
        </div>
      </div>
    </div>
  </div>
@endsection
