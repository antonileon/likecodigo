@extends('layouts.app')
@section('title', __('Ver empresa'))
@section('css')
@endsection

@section('content')
  <div class="content">
    <nav class="breadcrumb push bg-body-extra-light rounded-pill px-4 py-2">
      <a class="breadcrumb-item" href="javascript:void(0)">Empresas</a>
      <span class="breadcrumb-item active">Ver datos</span>
    </nav>
    <div class="row">
      <div class="col-12">
        <div class="block block-rounded">
          <div class="block-header block-header-default">
            <h3 class="block-title"><i class="fa fa-building"></i> Datos de la empresa</h3>
            <a href="{{ route('empresas.index') }}" class="btn btn-primary btn-sm" title="Regresar al listado">
              <i class="fa fa-arrow-left"></i> Regresar
            </a>
          </div>
          <div class="block-content">
            <div class="row">
              <div class="col-4">
                <div class="block block-rounded text-center">
                  <div class="block-content">
                    <img class="img-avatar img-avatar96" src="{{ asset('media/various/little-face.png') }}" alt="">
                  </div>
                  <div class="block-content block-content-full">
                    <div class="fs-lg fw-semibold mb-0 text-uppercase">{{ $empresa->nombre }}</div>
                    <div class="fw-medium text-muted">{{ $empresa->numero_identificacion }}</div>
                    @if($empresa->status=="Activo")
                      <span class="badge bg-success"><i class="fa fa-check me-1"></i> {{ $empresa->status }}</span>
                    @else
                      <span class="badge bg-danger"><i class="fa fa-times-circle me-1"></i> {{ $empresa->status }}</span>
                    @endif
                  </div>
                  <div class="block-content block-content-full bg-body-light">
                    <a class="btn btn-alt-primary" href="javascript:void(0)">
                      <i class="fab fa-fw fa-facebook-f"></i>
                    </a>
                    <a class="btn btn-alt-primary" href="javascript:void(0)">
                      <i class="fab fa-fw fa-instagram"></i>
                    </a>
                    <a class="btn btn-alt-primary" href="javascript:void(0)">
                      <i class="fab fa-fw fa-linkedin"></i>
                    </a>
                  </div>
                </div>
              </div>
              <div class="col-8">
                <div class="font-size-lg text-black text-uppercase">{{ $empresa->nombre }}</div>
                <div class="font-size-lg text-black"><strong>Fecha de registro:</strong> {{ $empresa->created_at }}</div>
                <address>
                  <strong>Dirección:</strong>
                </address>
                  <i class="fa fa-phone mr-5"></i> {{ $empresa->telefono }}<br>
                  <i class="fas fa-envelope mr-5"></i> <a href="javascript:void(0)">{{ $empresa->email }}</a>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="row">    
      <div class="col-md-6 col-xl-3">
        <a class="block block-rounded block-link-shadow" href="javascript:void(0)">
          <div class="block-content block-content-full block-sticky-options">
            <div class="block-options">
              <div class="block-options-item">
                <i class="far fa-circle fa-2x text-info-light"></i>
              </div>
            </div>
            <div class="py-3 text-center">
              <div class="fs-2 fw-bold mb-0 text-info">{{ $empresa->consultorios->count(); }}</div>
              <div class="fs-sm fw-semibold text-uppercase text-muted">Consultorios</div>
            </div>
          </div>
        </a>
      </div>
      <div class="col-md-6 col-xl-3">
        <a class="block block-rounded block-link-shadow" href="javascript:void(0)">
          <div class="block-content block-content-full block-sticky-options">
            <div class="block-options">
              <div class="block-options-item">
                <i class="fa fa-star fa-2x text-warning-light"></i>
              </div>
            </div>
            <div class="py-3 text-center">
              <div class="fs-2 fw-bold mb-0 text-warning">{{ $empresa->usuarios->count(); }}</div>
              <div class="fs-sm fw-semibold text-uppercase text-muted">Médicos</div>
            </div>
          </div>
        </a>
      </div>
      <div class="col-md-6 col-xl-3">
        <a class="block block-rounded block-link-shadow" href="javascript:void(0)">
          <div class="block-content block-content-full block-sticky-options">
            <div class="block-options">
              <div class="block-options-item">
                <i class="fa fa-exclamation-triangle fa-2x text-danger-light"></i>
              </div>
            </div>
            <div class="py-3 text-center">
              <div class="fs-2 fw-bold mb-0 text-danger">30</div>
              <div class="fs-sm fw-semibold text-uppercase text-muted">Pacientes</div>
            </div>
          </div>
        </a>
      </div>
      <div class="col-md-6 col-xl-3">
        <a class="block block-rounded block-link-shadow" href="be_pages_ecom_product_edit.html">
          <div class="block-content block-content-full block-sticky-options">
            <div class="block-options">
              <div class="block-options-item">
                <i class="fa fa-archive fa-2x text-success-light"></i>
              </div>
            </div>
            <div class="py-3 text-center">
              <div class="fs-2 fw-bold mb-0 text-success">
                30
              </div>
              <div class="fs-sm fw-semibold text-uppercase text-muted">Citas</div>
            </div>
          </div>
        </a>
      </div>    
    </div>
    
    
    <div class="row">
      <div class="col-12">
        <div class="block block-rounded overflow-hidden">
          <ul class="nav nav-tabs nav-tabs-block align-items-center" role="tablist">
            <li class="nav-item">
              <button class="nav-link active" id="btabswo-static-home-tab" data-bs-toggle="tab" data-bs-target="#btabswo-static-home" role="tab" aria-controls="btabswo-static-home" aria-selected="true">Listado de consultorios</button>
            </li>
            <li class="nav-item">
              <button class="nav-link" id="btabswo-static-profile-tab" data-bs-toggle="tab" data-bs-target="#btabswo-static-profile" role="tab" aria-controls="btabswo-static-profile" aria-selected="false">Listado de usuarios</button>
            </li>
            <li class="nav-item ms-auto">
              <div class="block-options ps-3 pe-2">
                <button type="button" class="btn-block-option" data-toggle="block-option" data-action="fullscreen_toggle"></button>
                <button type="button" class="btn-block-option" data-toggle="block-option" data-action="state_toggle" data-action-mode="demo">
                  <i class="si si-refresh"></i>
                </button>
                <button type="button" class="btn-block-option" data-toggle="block-option" data-action="content_toggle"></button>
              </div>
            </li>
          </ul>
          <div class="block-content tab-content">
            <div class="tab-pane active" id="btabswo-static-home" role="tabpanel" aria-labelledby="btabswo-static-home-tab">
              <div class="block-content block-content-full">
                <div class="table-responsive">
                  <table class="table table-bordered table-striped table-vcenter js-dataTable-responsive table-sm" id="consultoriosTable">
                    <thead>
                      <tr>
                        <th style="width: 100px;">ID</th>
                        <th>Nombre</th>
                        <th class="d-none d-sm-table-cell">Teléfono</th>
                        <th>Acciones</th>
                      </tr>
                    </thead>
                    <tbody>
                      @if(count($empresa->consultorios)>0)
                        @foreach($empresa->consultorios as $consultorio)
                          <tr>
                            <td>
                              <a class="font-w600" href="{{ route('consultorios.show', $consultorio->slug) }}">{{ $consultorio->id }}</a>
                            </td>
                            <td>
                              {{ $consultorio->nombre }}
                            </td>
                            <td class="d-none d-sm-table-cell">
                              <a href="#">{{ $consultorio->telefono }}</a>
                            </td>
                            <td>
                              <a class="btn btn-sm btn-warning btn-rounded" href="{{ route('consultorios.edit', $consultorio->slug) }}" title="Editar datos del consultorio">
                                <i class="fa fa-pencil"></i>
                              </a>
                              <a class="btn btn-sm btn-danger btn-rounded" href="javascript:void(0)" title="Eliminar consultorio">
                                <i class="fa fa-trash"></i>
                              </a>
                            </td> 
                          </tr>
                        @endforeach
                      @else
                        <tr>
                          <td colspan="4" style="text-align: center;">Esta empresa no posee consultorios registrados.</td>
                        </tr>
                      @endif
                    </tbody>
                  </table>
                </div>                
              </div>
            </div>
            <div class="tab-pane" id="btabswo-static-profile" role="tabpanel" aria-labelledby="btabswo-static-profile-tab">
              <div class="block-content block-content-full">
                <div class="table-responsive">
                  <table class="table table-bordered table-striped table-vcenter js-dataTable-responsive table-sm" id="usuariosTable">
                    <thead>
                      <tr>
                        <th style="width: 100px;">ID</th>
                        <th>Nombre</th>
                        <th class="d-none d-sm-table-cell">Teléfono</th>
                        <th>Acciones</th>
                      </tr>
                    </thead>
                    <tbody>
                      @if(count($empresa->usuarios)>0)
                        @foreach($empresa->usuarios as $usuario)
                          <tr>
                            <td>
                              <a class="font-w600" href="{{ route('consultorios.show', $usuario->slug) }}">{{ $usuario->id }}</a>
                            </td>
                            <td>
                              {{ $usuario->nombre }}
                            </td>
                            <td class="d-none d-sm-table-cell">
                              <a href="#">{{ $usuario->tipo_usuario->nombre }}</a>
                            </td>
                            <td>
                              <a class="btn btn-sm btn-warning btn-rounded" href="{{ route('consultorios.edit', $usuario->slug) }}" title="Editar datos del consultorio">
                                <i class="fa fa-pencil"></i>
                              </a>
                              <a class="btn btn-sm btn-danger btn-rounded" href="javascript:void(0)" title="Eliminar consultorio">
                                <i class="fa fa-trash"></i>
                              </a>
                            </td> 
                          </tr>
                        @endforeach
                      @else
                        <tr>
                          <td colspan="4" style="text-align: center;">Esta empresa no posee usuarios registrados.</td>
                        </tr>
                      @endif
                    </tbody>
                  </table>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
@endsection
@section('scripts')
  <script>
    $(document).ready( function () {
      $('#consultoriosTable').DataTable({
        language: {
          sProcessing  : "Cargando registros...",
          url: '//cdn.datatables.net/plug-ins/9dcbecd42ad/i18n/Spanish.json',
          searchPlaceholder: "Buscar registro",
        }
      })
    });
    $(document).ready( function () {
      $('#usuariosTable').DataTable({
        language: {
          sProcessing  : "Cargando registros...",
          url: '//cdn.datatables.net/plug-ins/9dcbecd42ad/i18n/Spanish.json',
          searchPlaceholder: "Buscar registro",
        }
      })
    });
  </script>
@endsection