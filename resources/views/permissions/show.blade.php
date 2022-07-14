@extends('layouts.app')

@section('css')
@endsection

@section('content')
  <!-- Page Content -->
  <div class="content">
    <nav class="breadcrumb bg-white push">
      <a class="breadcrumb-item" href="javascript:void(0)">Permisos</a>
      <span class="breadcrumb-item active">Ver</span>
    </nav>
    <!-- Dynamic Table Full -->
    <div class="block">
      <div class="block-header block-header-default">
        <h3 class="block-title"><i class="fa fa-cogs"></i> Ver permiso</h3>
        <a href="{{ route('permissions.index') }}" class="btn btn-primary btn-sm" title="Regresar al listado"><i class="fa fa-arrow-left"></i> Regresar</a>
      </div>
      <div class="block-content block-content-full">
        <div class="col-sm-12 py-10">
          <h3 class="h5 font-w700 mb-10">
            <i class="fa fa-circle text-success mr-5"></i> {{ $permission->description }}
          </h3>
          <p class="font-size-sm mb-10">
            <a class="mr-5 mb-5" href="javascript:void(0)">{{ $permission->name }}</a>
          </p>
          <p class="font-size-sm text-muted mb-0">
            Registrado el {{ date("d-m-Y H:i", strtotime($permission->created_at)) }}
          </p>
          <p class="font-size-sm text-muted mb-0">
            Modificado el {{ date("d-m-Y H:i", strtotime($permission->updated_at)) }}
          </p>
        </div>
      </div>
    </div>
    <!-- END Dynamic Table Full -->
  </div>
@endsection
