<script src="{{ asset('js/lib/jquery.min.js') }}"></script>
<script src="https://code.jquery.com/ui/1.13.2/jquery-ui.js"></script>
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
<script src="{{ asset('js/funciones.js?v=1') }}"></script>
<script>Codebase.helpersOnLoad(['jq-select2']);</script>
@yield('scripts')