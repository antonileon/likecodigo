@extends('layouts.app')
@section('title', __('Consultorios'))
@section('css')
@endsection

@section('content')
  <!-- Page Content -->
  <div class="content">
    <nav class="breadcrumb push bg-body-extra-light rounded-pill px-4 py-2">
      <a class="breadcrumb-item" href="javascript:void(0)">Consultorios</a>
      <span class="breadcrumb-item active">Listado</span>
    </nav>
    <!-- Dynamic Table Full -->
    <div class="block block-rounded">
      <div class="block-header block-header-default">
        <h3 class="block-title"><i class="fa fa-hospital"></i> Consultorios</h3>
        <a href="{{ route('consultorios.create') }}" class="btn btn-primary btn-sm" title="Registrar consultorio"><i class="fa fa-edit"></i> Registrar</a>
      </div>
      <div class="block-content block-content-full">
        <table class="table table-bordered table-striped table-vcenter js-dataTable-full table-sm" id="consultoriosTable">
          <thead>
            <tr>
              <th>Nombre</th>
              <th class="d-none d-sm-table-cell" style="width: 30%;">Teléfono</th>
              <th style="width:15%;">Acciones</th>
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
      $('#consultoriosTable').DataTable({
        oLanguage: {
          sProcessing  : "<i class='fa fa-spinner fa-spin'></i> Cargando registros...",
          searchPlaceholder: "Buscar registro",
        },
        language: {
          url: '//cdn.datatables.net/plug-ins/9dcbecd42ad/i18n/Spanish.json'
        },
        processing: true,
        serverSide: true,
        responsive: true,
        autoWidth:false,
        ajax: "{{ url('consultorios/get-index') }}",
        columns: [
          { data: 'nombre'},
          { data: 'telefono'},
          { data: 'acciones'},
        ],
        order: [[0, 'desc']],
        columnDefs:[
          {targets: [2], orderable: false},
        ]
      });
    });
    //--CODIGO PARA ELIMINAR USUARIO------------------//
    $('body').on('click', '#eliminarConsultorio', function() {
      var id = $(this).data('mc');
      Swal.fire({
        title: '¿Estás seguro que desea eliminar este consultorio?',
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
            url: "consultorios/"+id+"",
            data: { id: id },
            dataType: 'json',
            success: function(data){
              Toast.fire({
                icon: data.icono,
                title: data.mensaje
              })
              var oTable = $('#consultoriosTable').dataTable();
              oTable.fnDraw(false);
            },
            error: function (data) {
              Toast.fire({
                icon: 'error',
                title: 'Error del servidor, consultorio no eliminado.'
              })
            }
          });
        }
      })
    });
  </script>
@endsection