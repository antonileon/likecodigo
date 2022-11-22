@extends('layouts.app')
@section('title', __('Permisos'))
@section('css')
@endsection

@section('content')
  <!-- Page Content -->
  <div class="content">
    <nav class="breadcrumb push bg-body-extra-light rounded-pill px-4 py-2">
      <a class="breadcrumb-item" href="javascript:void(0)">Permisos</a>
      <span class="breadcrumb-item active">Listado</span>
    </nav>
    <!-- Dynamic Table Full -->
    <div class="block block-rounded">
      <div class="block-header block-header-default">
        <h3 class="block-title"><i class="fa fa-cogs"></i> Permisos</h3>
        <a href="{{ route('permissions.create') }}" class="btn btn-primary btn-sm" title="Registrar rol"><i class="fa fa-edit"></i> Registrar</a>
      </div>
      <div class="block-content block-content-full">
        <table class="table table-bordered table-striped table-vcenter js-dataTable-full table-sm" id="permisosTable" style="font-size: 12px;">
          <thead>
            <tr>
              <th>Descripción</th>
              <th>Nombre</th>
              <th width="20%">Acciones</th>
            </tr>
          </thead>
          <tbody></tbody>
        </table>
      </div>
    </div>
  </div>
@endsection
@section('scripts')
  <script type="text/javascript">
    $(document).ready( function () {
      $('#permisosTable').DataTable({
        language: {
          sProcessing  : "Cargando registros...",
          url: '//cdn.datatables.net/plug-ins/9dcbecd42ad/i18n/Spanish.json',
          searchPlaceholder: "Buscar registro",
        },
        processing: true,
        serverSide: true,
        responsive: true,
        autoWidth:false,
        ajax: "{{ url('permissions/get-index') }}",
        columns: [
          { data: 'description'},
          { data: 'name'},
          { data: 'acciones'},
        ],
        order: [[0, 'desc']],
        columnDefs:[
          {targets: [2], orderable: false},
        ]
      });
    });

    //--CODIGO PARA ELIMINAR PERMISO------------------//
    $('body').on('click', '#eliminarPermiso', function() {
      var id = $(this).data('mc');
      Swal.fire({
        title: '¿Estás seguro que desea eliminar este permiso?',
        text: "¡Esta opción no podrá deshacerse en el futuro!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: '¡Si, Eliminar!',
        cancelButtonText: 'No, Cancelar!'
      }).then((result) => {
        if (result.isConfirmed) {
          $.ajaxSetup({
            headers: {
              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
          });
          $.ajax({
            type:"DELETE",
            url: "permissions/"+id+"",
            data: { id: id },
            dataType: 'json',
            success: function(data) {
              actualizaTabla('permisosTable')
              alerta(data.tipo,data.mensaje)
            },
            error: function (data) {
              errorSistema()
            }
          });
        }
      })
    });
  </script>
@endsection