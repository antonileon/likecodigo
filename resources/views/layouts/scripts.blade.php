<script src="{{ asset('js/codebase.app.js') }}"></script>
<script src="{{ asset('js/plugins/sweetalert2/sweetalert2.min.js') }}"></script>

<!--Select2 -->
<script src="{{ asset('js/plugins/select2/js/select2.full.min.js') }}"></script>
<script src="{{ asset('js/plugins/select2/js/i18n/es.js') }}"></script>
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
</script>
@yield('scripts')