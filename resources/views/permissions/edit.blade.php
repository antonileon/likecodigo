@extends('layouts.app')

@section('css')
  <!-- Page JS Plugins CSS -->
  <link rel="stylesheet" href="{{ asset('js/plugins/datatables/dataTables.bootstrap4.css') }}">
@endsection

@section('content')
  <!-- Page Content -->
  <div class="content">
    <nav class="breadcrumb bg-white push">
      <a class="breadcrumb-item" href="javascript:void(0)">Roles</a>
      <span class="breadcrumb-item active">Editar</span>
    </nav>
    <!-- Dynamic Table Full -->
    <div class="block">
      <div class="block-header block-header-default">
        <h3 class="block-title"><i class="fa fa-cogs"></i> Editar permiso</h3>
        <a href="{{ route('permissions.index') }}" class="btn btn-primary btn-sm" title="Regresar al listado"><i class="fa fa-arrow-left"></i> Regresar</a>
      </div>
      <div class="block-content block-content-full">
        {!! Form::model($permission,['route'=>['permissions.update',$permission],'method'=>'put','autocomplete'=>'off']) !!}
          @include('permissions.partials._formulario', ['btnText' => 'Modificar'])
        {!! Form::close() !!}
      </div>
    </div>
    <!-- END Dynamic Table Full -->
  </div>
@endsection
