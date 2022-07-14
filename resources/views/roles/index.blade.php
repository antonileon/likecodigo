@extends('layouts.app')
@section('title', __('Roles'))
@section('css')
  <link rel="stylesheet" href="{{ asset('js/plugins/datatables/dataTables.bootstrap4.css') }}">
@endsection

@section('content')
  <!-- Page Content -->
  <div class="content">
    <nav class="breadcrumb bg-white push">
      <a class="breadcrumb-item" href="javascript:void(0)">Roles</a>
      <span class="breadcrumb-item active">Listado</span>
    </nav>
    <!-- Dynamic Table Full -->
    <div class="block">
      <div class="block-header block-header-default">
        <h3 class="block-title"><i class="fa fa-cogs"></i> Roles</h3>
        <a href="{{ route('roles.create') }}" class="btn btn-primary btn-sm" title="Registrar rol"><i class="fa fa-edit"></i> Registrar</a>
      </div>
      <div class="block-content block-content-full">
        <table class="table table-bordered table-striped table-vcenter js-dataTable-full table-sm" id="rolesTable">
          <thead>
            <tr>
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
      $('#rolesTable').DataTable({
        oLanguage: {
          sProcessing  : "<i class='fa fa-spinner fa-spin'></i> Cargando registros...",
        },
        language: {
          url: '//cdn.datatables.net/plug-ins/9dcbecd42ad/i18n/Spanish.json'
        },
        processing: true,
        serverSide: true,
        responsive: true,
        autoWidth:false,
        ajax: "{{ url('roles/get-index') }}",
        columns: [
          { data: 'name'},
          { data: 'acciones'},
        ],
        order: [[0, 'desc']],
        columnDefs:[
          {targets: [1], orderable: false},
        ]
      });
    });

    //--CODIGO PARA ELIMINAR PBX ---------------------//
    $('body').on('click', '#eliminarRol', function() {
      var id = $(this).data('id');
      console.log(id);
      Swal.fire({
        title: '¿Estás seguro que desea eliminar este rol?',
        text: "¡Esta opción no podrá deshacerse en el futuro!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: '¡Si, Eliminar!',
        cancelButtonText: 'No, Cancelar!'
      }).then((result) => {
        if (result.isConfirmed) {
          $.ajax({
            type:"DELETE",
            url: "roles/"+id+"",
            data: { id: id },
            dataType: 'json',
            success: function(response){
              Swal.fire ( response.titulo ,  response.message ,  response.icono );
              var oTable = $('#rolesTable').dataTable();
              oTable.fnDraw(false);
            },
            error: function (data) {
              Swal.fire({title: "Error del sistema", text:  "Rol no eliminada", icon:  "error"});
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