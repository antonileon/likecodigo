@extends('layouts.app')
@section('title', __('Servicios'))
@section('css')
@endsection

@section('content')
  <!-- Page Content -->
  <div class="content">
    <nav class="breadcrumb push bg-body-extra-light rounded-pill px-4 py-2">
      <a class="breadcrumb-item" href="javascript:void(0)">Servicios</a>
      <span class="breadcrumb-item active">Listado</span>
    </nav>
    <!-- Dynamic Table Full -->
    <div class="block block-rounded">
      <div class="block-header block-header-default">
        <h3 class="block-title"><i class="nav-main-link-icon fa-solid fa-tooth"></i> Servicios</h3>
        <a class="btn btn-primary btn-sm" title="Registrar servicio" id="registrarServicio"><i class="fa fa-edit"></i> Registrar</a>
      </div>
      <div class="block-content block-content-full">
        <table class="table table-bordered table-striped table-vcenter js-dataTable-full table-sm" id="serviciosTable" style="font-size: 12px;">
          <thead>
            <tr>
              <th>Servicio</th>
              <th>Precio</th>
              <th>Acciones</th>
            </tr>
          </thead>
          <tbody></tbody>
        </table>
      </div>
    </div>
  </div>
@include('servicios.partials._create')
@include('servicios.partials._edit')
@endsection
@section('scripts')
  <script type="text/javascript">
    $(document).ready( function () {
      $('#serviciosTable').DataTable({
        language: {
          searchPlaceholder: "Buscar registro",
          url: '//cdn.datatables.net/plug-ins/9dcbecd42ad/i18n/Spanish.json'
        },
        processing: true,
        serverSide: true,
        responsive: true,
        autoWidth:false,
        ajax: "{{ url('servicios/get-index') }}",
        columns: [
          { data: 'servicio'},
          { data: 'precio'},
          { data: 'acciones'},
        ],
        order: [[0, 'desc']],
        columnDefs:[
          {targets: [2], orderable: false},
        ]
      });
    });
    // ABRIR MODAL DE REGISTRO
    $("#registrarServicio").click(function() {
      $('#formRegistrarServicio').trigger("reset");
      abrirModal('registrar-servicio')
    });
    // GUARDAR SERVICIO
    $('#SubmitRegistrarServicio').click(function(e) {
      let servicio = $("#servicio").val();
      let precio   = $("#precio").val();
      if (servicio=='') {
        alerta('warning','El campo servicio es obligatorio.')
        return false;
      }
      if (precio=='') {
        alerta('warning','El campo precio es obligatorio.')
        return false;
      }
      e.preventDefault();
      $.ajaxSetup({
        headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
      });
      $.ajax({
        url: "{{ route('servicios.store') }}",
        method: 'POST',
        data: {
          servicio: servicio,
          precio : precio
        },
        beforeSend: function() {
          loadButton('SubmitRegistrarServicio');
        },
        success: function(result) {
          if (result.tipo=="success") {
            actualizaTabla('serviciosTable');
            cerrarModal('registrar-servicio');
          }
          alerta(result.tipo,result.mensaje)
        },
        complete: function(response) {
          loadButton('SubmitRegistrarServicio',false);
        },
        error: function(response) {
          loadButton('SubmitRegistrarServicio',false);
          errorSistema()
        }
      });
    });
    // ABRIR MODAL PARA EDITAR SERVICIO
    $('body').on('click', '#editarServicio', function () {
      var id = $(this).data('id');
      $.ajax({
        method:"GET",
        url: "servicios/"+id+"/edit",
        dataType: 'json',
        success: function(data){
          abrirModal('editar-servicio')
          $('#inputSlugServicio').val(data.slug);
          $('#inputServicio').val(data.servicio);
          $('#inputPrecio').val(data.precio);
        },
        error: function() {
          errorSistema()
        }
      });
    });
    // EDITAR SERVICIO
    $('#SubmitEditarServicio').click(function(e) {
      e.preventDefault();
      var id = $('#inputSlugServicio').val();
      let servicio = $("#inputServicio").val();
      let precio   = $("#inputPrecio").val();
      if (servicio=='') {
        alerta('warning','El campo servicio es obligatorio.')
        return false;
      }
      if (precio=='') {
        alerta('warning','El campo precio es obligatorio.')
        return false;
      }
      $.ajaxSetup({
        headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
      });
      $.ajax({
        method:'PUT',
        url: "servicios/"+id+"",
        data: {
          servicio: servicio,
          precio : precio
        },
        success: (data) => {
          if (data.tipo=="success") {
            actualizaTabla('serviciosTable');
            cerrarModal('editar-servicio');
          }
          alerta(data.tipo,data.mensaje)
        },
        error: function(data){
          errorSistema()          
        }
      });
    });
    //--CODIGO PARA ELIMINAR SERVICIO------------------//
    $('body').on('click', '#eliminarServicio', function() {
      var id = $(this).data('mc');
      Swal.fire({
        title: '¿Estás seguro que desea eliminar este servicio?',
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
            url: "servicios/"+id+"",
            data: { id: id },
            dataType: 'json',
            success: function(data) {
              actualizaTabla('serviciosTable')
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