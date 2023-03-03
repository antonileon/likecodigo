@extends('layouts.app')
@section('title', __('Empresas'))
@section('css')
@endsection

@section('content')
  <div class="content">
    <nav class="breadcrumb push bg-body-extra-light rounded-pill px-4 py-2">
      <a class="breadcrumb-item" href="javascript:void(0)">Empresas</a>
      <span class="breadcrumb-item active">Listado</span>
    </nav>
    <div class="block block-rounded">
      <div class="block-header block-header-default">
        <h3 class="block-title"><i class="fa fa-building"></i> Empresas</h3>
        <a href="{{ route('empresas.create') }}" class="btn btn-primary btn-sm" title="Registrar empresa"><i class="fa fa-edit"></i> Registrar</a>
      </div>
      <div class="block-content block-content-full">
        <div class="table-responsive">
        </div>
          <table class="table table-bordered table-striped table-vcenter js-dataTable-responsive table-sm" id="empresasTable" style="font-size: 12px;">
            <thead>
              <tr>
                <th>Nombre</th>
                <th>N° de identificación</th>
                <th>Email</th>
                <th>N° consultorios</th>
                <th>N° usuarios</th>
                <th>Status</th>
                <th>Acciones</th>
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
      $('#empresasTable').DataTable({
        language: {
          sProcessing  : "Cargando registros...",
          url: '//cdn.datatables.net/plug-ins/9dcbecd42ad/i18n/Spanish.json',
          searchPlaceholder: "Buscar registro",
        },
        processing: true,
        serverSide: true,
        responsive: true,
        autoWidth:false,
        ajax: "{{ url('empresas/get-index') }}",
        columns: [
          { data: 'nombre'},
          { data: 'numero_identificacion'},
          { data: 'email'},
          { data: 'numero_consultorios'},
          { data: 'numero_usuarios'},
          { data: 'status'},
          { data: 'acciones'},
        ],
        order: [[0, 'desc']],
        columnDefs:[
          {targets: [3], orderable: false},
          {targets: [4], orderable: false},
          {targets: [6], orderable: false},
        ]
      });
    });

    //--CODIGO PARA ELIMINAR EMPRESA------------------//
    $('body').on('click', '#eliminarEmpresa', function() {
      var id = $(this).data('mc');
      Swal.fire({
        title: '¿Estás seguro que desea eliminar esta empresa?',
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
            url: "empresas/"+id+"",
            data: { id: id },
            dataType: 'json',
            success: function(data){
              alerta(data.tipo,data.mensaje)
              var oTable = $('#empresasTable').dataTable();
              oTable.fnDraw(false);
            },
            error: function (data) {
              alerta('Error','Error del servidor, empresa no eliminada.')
            }
          });
        }
      })
    });
  </script>
@endsection