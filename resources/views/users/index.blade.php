@extends('layouts.app')
@section('title', __('Usuarios'))
@section('css')
@endsection

@section('content')
  <!-- Page Content -->
  <div class="content">
    <nav class="breadcrumb push bg-body-extra-light rounded-pill px-4 py-2">
      <a class="breadcrumb-item" href="javascript:void(0)">Usuarios</a>
      <span class="breadcrumb-item active">Listado</span>
    </nav>
    <!-- Dynamic Table Full -->
    <div class="block block-rounded">
      <div class="block-header block-header-default">
        <h3 class="block-title"><i class="fa fa-users"></i> Usuarios</h3>
        <a href="{{ route('users.create') }}" class="btn btn-primary btn-sm"><i class="fa fa-edit"></i> Registrar</a>
      </div>
      <div class="block-content block-content-full">
        <table class="table table-bordered table-striped table-vcenter js-dataTable-full table-sm" id="usersTable" style="font-size: 12px;">
          <thead>
            <tr>
              <th>Nombres</th>
              <th style="width: 15%;">Email</th>
              <th>Tipo de usuario</th>
              <th>Empresa</th>
              <th>Status</th>
              <th>Acciones</th>
            </tr>
          </thead>
          <tbody></tbody>
        </table>
      </div>
    </div>
    <!-- END Dynamic Table Full -->
  </div>
@endsection
@section('scripts')
  <script type="text/javascript">
    $(document).ready( function () {
      $('#usersTable').DataTable({
        language: {
          sProcessing  : "Cargando registros...",
          url: '//cdn.datatables.net/plug-ins/9dcbecd42ad/i18n/Spanish.json',
          searchPlaceholder: "Buscar registro",
        },
        processing: true,
        serverSide: true,
        responsive: true,
        autoWidth:false,
        ajax: "{{ url('users/get-index') }}",
        columns: [
          { data: 'nombre'},
          { data: 'email'},
          { data: 'tipo_usuario_id'},
          { data: 'empresa_id'},
          { data: 'status'},
          { data: 'acciones'},
        ],
        order: [[0, 'desc']],
        columnDefs:[
          {targets: [5], orderable: false},
        ]
      });
    });
    //--CODIGO PARA ELIMINAR USUARIO------------------//
    $('body').on('click', '#eliminarUsuario', function() {
      var id = $(this).data('mc');
      Swal.fire({
        title: '¿Estás seguro que desea eliminar este usuario?',
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
            url: "users/"+id+"",
            data: { id: id },
            dataType: 'json',
            success: function(data){
              Toast.fire({
                icon: data.icono,
                title: data.mensaje
              })
              var oTable = $('#usersTable').dataTable();
              oTable.fnDraw(false);
            },
            error: function (data) {
              Toast.fire({
                icon: 'error',
                title: 'Error del servidor, usuario no eliminado.'
              })
            }
          });
        }
      })
    });
  </script>
@endsection