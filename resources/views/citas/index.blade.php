@extends('layouts.app')
@section('title', __('Citas'))
@section('css')
@endsection

@section('content')
  <!-- Page Content -->
  <div class="content">
    <nav class="breadcrumb push bg-body-extra-light rounded-pill px-4 py-2">
      <a class="breadcrumb-item" href="javascript:void(0)">Citas</a>
      <span class="breadcrumb-item active">Listado</span>
    </nav>
    <!-- Dynamic Table Full -->
    <div class="block block-rounded">
      <div class="block-header block-header-default">
        <h3 class="block-title"><i class="nav-main-link-icon fa-solid fa-clock"></i> Citas</h3>
        <a href="{{ route('citas.create') }}" class="btn btn-primary btn-sm" title="Registrar especialidad" id=""><i class="fa fa-edit"></i> Registrar</a>
      </div>
      <div class="block-content block-content-full">
        <table class="table table-bordered table-striped table-vcenter js-dataTable-full table-sm text-uppercase" id="especialidadesTable" style="font-size: 12px;">
          <thead>
            <tr>
              <th>ID</th>
              <th class="d-none d-sm-table-cell">Paciente</th>
              <th class="d-none d-sm-table-cell">Servicio</th>
              <th class="d-none d-sm-table-cell">Costo</th>
              <th class="d-none d-sm-table-cell">Fecha</th>
              <th class="d-none d-sm-table-cell">Hora</th>
              <th class="d-none d-sm-table-cell">Médico</th>
              <th class="d-none d-sm-table-cell">Estado</th>
              <th>Acciones</th>
            </tr>
          </thead>
          <tbody></tbody>
        </table>
      </div>
    </div>
  </div>
@include('citas.partials._create')
@include('citas.partials._edit')
@endsection
@section('scripts')
  <script type="text/javascript">
    $(document).ready( function () {
      $('#especialidadesTable').DataTable({
        language: {
          sProcessing  : "Cargando registros...",
          searchPlaceholder: "Buscar registro",
          url: '//cdn.datatables.net/plug-ins/9dcbecd42ad/i18n/Spanish.json'
        },
        processing: true,
        serverSide: true,
        responsive: true,
        autoWidth:false,
        ajax: "{{ url('citas/get-index') }}",
        columns: [
          { data: 'id'},
          { data: 'paciente'},
          { data: 'servicio'},
          { data: 'costo'},
          { data: 'fecha'},
          { data: 'hora'},
          { data: 'medico'},
          { data: 'estado'},
          { data: 'acciones'},
        ],
        order: [[0, 'desc']],
        columnDefs:[
          {targets: [2], orderable: false},
          {targets: [3], orderable: false},
        ]
      });
    });
    // ABRIR MODAL DE REGISTRO
    $("#registrarCita").click(function() {
      $('#formRegistrarCita').trigger("reset");
      abrirModal('registrar-cita')
    });
    // GUARDAR ESPECIALIDAD
    $('#SubmitRegistrarEspecialidad').click(function(e) {
      let especialidad = $("#especialidad").val();
      if (especialidad=='') {
        alerta('warning','El campo especialidad es obligatorio.')
        return false;
      }
      e.preventDefault();
      $.ajaxSetup({
        headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
      });
      $.ajax({
        url: "{{ route('especialidades.store') }}",
        method: 'POST',
        data: {
          especialidad: especialidad,
        },
        beforeSend: function() {
          loadButton('SubmitRegistrarEspecialidad');
        },
        success: function(result) {
          if (result.tipo=="success") {
            actualizaTabla('especialidadesTable');
            cerrarModal('registrar-especialidad');
          }
          alerta(result.tipo,result.mensaje)
        },
        complete: function(response) {
          loadButton('SubmitRegistrarEspecialidad',false);
        },
        error: function(response) {
          loadButton('SubmitRegistrarEspecialidad',false);
          errorSistema()
        }
      });
    });
    // ABRIR MODAL PARA EDITAR ESPECIALIDAD
    $('body').on('click', '#editarEspecialidad', function () {
      var id = $(this).data('id');
      $.ajax({
        method:"GET",
        url: "especialidades/"+id+"/edit",
        dataType: 'json',
        success: function(data){
          abrirModal('editar-especialidad')
          $('#inputSlugEspecialidad').val(data.slug);
          $('#inputEspecialidad').val(data.especialidad);
        },
        error: function() {
          errorSistema()
        }
      });
    });
    // EDITAR ESPECIALIDAD
    $('#SubmitEditarEspecialidad').click(function(e) {
      e.preventDefault();
      var id = $('#inputSlugEspecialidad').val();
      let especialidad = $("#inputEspecialidad").val();
      if (especialidad=='') {
        alerta('warning','El campo especialidad es obligatorio.')
        return false;
      }
      $.ajaxSetup({
        headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
      });
      $.ajax({
        method:'PUT',
        url: "especialidades/"+id+"",
        data: {
          especialidad: especialidad,
        },
        success: (data) => {
          if (data.tipo=="success") {
            actualizaTabla('especialidadesTable');
            cerrarModal('editar-especialidad');
          }
          alerta(data.tipo,data.mensaje)
        },
        error: function(data){
          errorSistema()          
        }
      });
    });
    //--CODIGO PARA ELIMINAR EMPRESA------------------//
    $('body').on('click', '#eliminarEspecialidad', function() {
      var id = $(this).data('mc');
      Swal.fire({
        title: '¿Estás seguro que desea eliminar este especialidad?',
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
            url: "especialidades/"+id+"",
            data: { id: id },
            dataType: 'json',
            success: function(data){
              actualizaTabla('especialidadesTable')
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