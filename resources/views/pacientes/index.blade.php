@extends('layouts.app')
@section('title', __('Pacientes'))
@section('css')
@endsection

@section('content')
  <!-- Page Content -->
  <div class="content">
    <nav class="breadcrumb push bg-body-extra-light rounded-pill px-4 py-2">
      <a class="breadcrumb-item" href="javascript:void(0)">Pacientes</a>
      <span class="breadcrumb-item active">Listado</span>
    </nav>
    <!-- Dynamic Table Full -->
    <div class="block block-rounded">
      <div class="block-header block-header-default">
        <h3 class="block-title"><i class="nav-main-link-icon fa fa-user-tie"></i> Pacientes</h3>
        <a href="{{ route('pacientes.create') }}" class="btn btn-primary btn-sm" title="Registrar empresa"><i class="fa fa-edit"></i> Registrar</a>&nbsp;
        <a href="{{ route('excel.pacientes') }}" class="btn btn-danger btn-sm" title="Reporte Excel" target="_blank"><i class="fa fa-file-excel"></i> Reporte Excel</a>
      </div>
      <div class="block-content block-content-full">
        <table class="table table-bordered table-striped table-vcenter js-dataTable-full table-sm" id="pacientesTable" style="font-size: 12px;">
          <thead>
            <tr>
              <th>Nombre</th>
              <th class="d-none d-sm-table-cell">Número de identificación</th>
              <th>teléfono</th>
              <th>Email</th>
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
      $('#pacientesTable').DataTable({
        language: {
          sProcessing  : "Cargando registros...",
          searchPlaceholder: "Buscar registro",
          url: '//cdn.datatables.net/plug-ins/9dcbecd42ad/i18n/Spanish.json'
        },
        processing: true,
        serverSide: true,
        responsive: true,
        autoWidth:false,
        ajax: "{{ url('pacientes/get-index') }}",
        columns: [
          { data: 'nombre'},
          { data: 'numero_identificacion'},
          { data: 'telefono'},
          { data: 'email'},
          { data: 'acciones'},
        ],
        order: [[0, 'desc']],
        columnDefs:[
          {targets: [4], orderable: false},
        ]
      });
    });
    //--CODIGO PARA ELIMINAR EMPRESA------------------//
    $('body').on('click', '#eliminarPaciente', function() {
      var id = $(this).data('mc');
      Swal.fire({
        title: '¿Estás seguro que desea eliminar este paciente?',
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
            url: "pacientes/"+id+"",
            data: { id: id },
            dataType: 'json',
            success: function(data){
              Toast.fire({
                icon: data.icono,
                title: data.mensaje
              })
              var oTable = $('#pacientesTable').dataTable();
              oTable.fnDraw(false);
            },
            error: function (data) {
              Toast.fire({
                icon: 'error',
                title: 'Error del servidor, paciente no eliminado.'
              })
            }
          });
        }
      })
    });
  </script>
@endsection