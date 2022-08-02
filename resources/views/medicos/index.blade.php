@extends('layouts.app')
@section('title', __('Médicos'))
@section('css')
  <link rel="stylesheet" href="{{ asset('js/plugins/datatables/dataTables.bootstrap4.css') }}">
@endsection

@section('content')
  <!-- Page Content -->
  <div class="content">
    <nav class="breadcrumb bg-white push">
      <a class="breadcrumb-item" href="javascript:void(0)">Médicos</a>
      <span class="breadcrumb-item active">Listado</span>
    </nav>
    <!-- Dynamic Table Full -->
    <div class="block">
      <div class="block-header block-header-default">
        <h3 class="block-title"><i class="fa fa-building"></i> Médicos</h3>
        <a href="{{ route('medicos.create') }}" class="btn btn-primary btn-sm" title="Registrar empresa"><i class="fa fa-edit"></i> Registrar</a>
      </div>
      <div class="block-content block-content-full">
        <table class="table table-bordered table-striped table-vcenter js-dataTable-full table-sm" id="medicosTable">
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
      $('#medicosTable').DataTable({
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
        ajax: "{{ url('medicos/get-index') }}",
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
    $('body').on('click', '#eliminarMedico', function() {
      var id = $(this).data('mc');
      Swal.fire({
        title: '¿Estás seguro que desea eliminar este médico?',
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
            url: "medicos/"+id+"",
            data: { id: id },
            dataType: 'json',
            success: function(data){
              Toast.fire({
                icon: data.icono,
                title: data.mensaje
              })
              var oTable = $('#medicosTable').dataTable();
              oTable.fnDraw(false);
            },
            error: function (data) {
              Toast.fire({
                icon: 'error',
                title: 'Error del servidor, medico no eliminado.'
              })
            }
          });
        }
      })
    });
  </script>
  <!-- Page JS Plugins -->
  <script src="{{ asset('js/plugins/datatables/jquery.dataTables.min.js') }}"></script>
  <script src="{{ asset('js/plugins/datatables/dataTables.bootstrap4.min.js') }}"></script>
@endsection