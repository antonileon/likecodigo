@extends('layouts.app')

@section('css')
  <!-- Page JS Plugins CSS -->
  <link rel="stylesheet" href="{{ asset('js/plugins/datatables/dataTables.bootstrap4.css') }}">
@endsection

@section('content')
  <!-- Page Content -->
  <div class="content">
    <nav class="breadcrumb bg-white push">
      <a class="breadcrumb-item" href="javascript:void(0)">Empresas</a>
      <span class="breadcrumb-item active">Ver datos</span>
    </nav>
    <div class="row">      
      <div class="col-4">
        <div class="block block-rounded block-link-shadow text-center">
          <div class="block-content bg-gd-dusk">
            <div class="push">
              <img class="img-avatar img-avatar-thumb" src="{{ asset('media/avatars/avatar15.jpg') }}" alt="">
            </div>
            <div class="pull-r-l pull-b py-10 bg-black-op-25">
              <div class="font-w600 mb-5 text-white">
                {{ $empresa->nombre }} <i class="fa fa-star text-warning"></i>
              </div>
              <div class="font-size-sm text-white-op">Premium Member</div>
            </div>
          </div>
          <div class="block-content">
            <div class="row items-push text-center">
              <div class="col-6">
                <div class="mb-5"><i class="si si-bag fa-2x"></i></div>
                <div class="font-size-sm text-muted">6 Consultorios</div>
              </div>
              <div class="col-6">
                <div class="mb-5"><i class="si si-basket-loaded fa-2x"></i></div>
                <div class="font-size-sm text-muted">15 Usuarios</div>
              </div>
            </div>
            <div class="row items-push text-center">
              <div class="col-12">
                <a class="btn btn-sm btn-warning btn-rounded mr-5 my-5" href="{{ route('empresas.edit', $empresa->slug) }}" title="Editar datos de la empresa">
                  <i class="fa fa-pencil mr-5"></i> Editar
                </a>                
                <a class="btn btn-sm btn-danger btn-rounded mr-5 my-5" href="javascript:void(0)" title="Eliminar empresa">
                  <i class="fa fa-trash mr-5"></i> Eliminar
                </a>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="col-8">
        <div class="block block-rounded">
          <div class="block-header block-header-default">
            <h3 class="block-title">Datos de la empresa</h3>
            <a href="{{ route('empresas.index') }}" class="btn btn-primary btn-sm" title="Regresar al listado">
              <i class="fa fa-arrow-left"></i> Regresar
            </a>
          </div>
          <div class="block-content">
            <div class="font-size-lg text-black mb-5">John Smith</div>
            <address>
              5110 8th Ave<br>
              New York 11220<br>
              United States<br><br>
              <i class="fa fa-phone mr-5"></i> {{ $empresa->telefono }}<br>
              <i class="fa fa-envelope-o mr-5"></i> <a href="javascript:void(0)">{{ $empresa->email }}</a>
            </address>
          </div>
        </div>
        <div class="block block-rounded">
          <div class="block-header block-header-default">
            <h3 class="block-title">Listado de consultorios</h3>
          </div>
          <div class="block-content">
            <table class="table table-borderless table-striped">
              <thead>
                <tr>
                  <th style="width: 100px;">ID</th>
                  <th>Nombre</th>
                  <th class="d-none d-sm-table-cell">Teléfono</th>
                  <th>Acciones</th>
                </tr>
              </thead>
              <tbody>
                @foreach($empresa->consultorios as $consultorio)
                  <tr>
                    <td>
                      <a class="font-w600" href="{{ route('consultorios.show', $consultorio->slug) }}">{{ $consultorio->id }}</a>
                    </td>
                    <td>
                      {{ $consultorio->nombre }}
                    </td>
                    <td class="d-none d-sm-table-cell">
                      <a href="be_pages_ecom_customer.html">{{ $consultorio->telefono }}</a>
                    </td>
                    <td>
                      <a class="btn btn-sm btn-warning btn-rounded mr-5 my-5" href="{{ route('consultorios.edit', $consultorio->slug) }}" title="Editar datos del consultorio">
                        <i class="fa fa-pencil"></i>
                      </a>
                      <a class="btn btn-sm btn-danger btn-rounded mr-5 my-5" href="javascript:void(0)" title="Eliminar consultorio">
                        <i class="fa fa-trash"></i>
                      </a>
                    </td> 
                  </tr>
                @endforeach
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
  </div>
@endsection
