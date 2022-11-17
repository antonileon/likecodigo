$(document).ready(tema);
function tema() {
	if ($('#tema').prop('checked')) {
		$('#page-container').addClass('dark-mode sidebar-dark page-header-dark');
  		$("#icono_tema").append('<i class="fas fa-sun"></i>');
	} else {
		$('#page-container').removeClass('dark-mode sidebar-dark page-header-dark');
  		$("#icono_tema").append('<i class="fas fa-moon"></i>');
	}
}
$('#tema').click(function(e) {
	if ($(this).is(':checked')) {
		var tema = 1;
		$("#icono_tema").empty();
		$("#icono_tema").append('<i class="fas fa-sun"></i>');
	} else {
		var tema = 0;
		$("#icono_tema").empty();
		$("#icono_tema").append('<i class="fas fa-moon"></i>');
	}
	console.log(tema)
	$.ajaxSetup({
		headers: {
	  		'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
		}
	});
	$.ajax({
	    url: "/users/cambiar-tema",
	    method: 'POST',
	    data: {
	    	tema: tema,
	    },
	    success: function(data) {
	    	if (data==1) {
				$('#page-container').addClass('dark-mode sidebar-dark page-header-dark');
	    	} else {
				$('#page-container').removeClass('dark-mode sidebar-dark page-header-dark');
	    	}
	    }
	});
});
function alerta(tipo, text, duracion=5000) {
	// tipo : success warning error
  const Toast = Swal.mixin({
	  toast: true,
	  position: 'top-end',
	  showConfirmButton: false,
	  timer: duracion,
	  timerProgressBar: true,
	  didOpen: (toast) => {
	    toast.addEventListener('mouseenter', Swal.stopTimer)
	    toast.addEventListener('mouseleave', Swal.resumeTimer)
	  }
	})
	Toast.fire({
	  icon: tipo,
	  title: text
	})
}

function actualizaTabla(tabla) {
	var oTable = $('#'+tabla).dataTable();
	oTable.fnDraw(false);
}

function abrirModal(nombreModal) {
	$("#"+nombreModal).modal({
		show: true,
		backdrop: 'static',
		keyboard: false
	});
	$("#"+nombreModal).modal("show");
}

function cerrarModal(nombreModal) {
	$('#'+nombreModal).modal('hide');
}

function loadButton(id,estado=true,mensaje="Cargando"){
  if (estado== true){
    let button=$("#"+id).html();
    $("#"+id).attr("data-html",button);
    $("#"+id).attr("disabled",true);
    $("#"+id).html('<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>  '+mensaje);
  }else{
    var nombre=$("#"+id).attr("data-html");
    $("#"+id).attr("disabled",false);
    $("#"+id).html(nombre);
  }
}

function errorSistema() {
	alerta('error','¡Error del sistema! No se pudo realizar la acción, por favor contactese con el equipo de soporte soporte@likecodigo.com.')
}