<script src="{{ asset('js/lib/jquery.min.js') }}"></script>
<script src="{{ asset('js/codebase.app.js') }}"></script>
<script src="{{ asset('js/plugins/sweetalert2/sweetalert2.min.js') }}"></script>

<!--Select2 -->
<script src="{{ asset('js/plugins/select2/js/select2.full.min.js') }}"></script>
<script src="{{ asset('js/plugins/select2/js/i18n/es.js') }}"></script>
<!--Parsley -->
<script src="{{ asset('js/plugins/parsley/parsley.min.js') }}"></script>
<script src="{{ asset('js/plugins/parsley/i18n/es.js') }}"></script>
<!-- Datatables JS Plugins -->
<script src="{{ asset('js/plugins/datatables/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('js/plugins/datatables/datatables-bs5/js/dataTables.bootstrap5.min.js') }}"></script>
<script type="text/javascript">
	const Toast = Swal.mixin({
    	toast: true,
      	position: 'top-end',
		showConfirmButton: false,
		timer: 5000,
		timerProgressBar: true,
		didOpen: (toast) => {
			toast.addEventListener('mouseenter', Swal.stopTimer)
			toast.addEventListener('mouseleave', Swal.resumeTimer)
		}
    })
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
</script>
<script>Codebase.helpersOnLoad(['jq-select2']);</script>
@yield('scripts')