	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">

	<title>LikeDental | @yield('title')</title>

	<meta name="description" content="Codebase - Bootstrap 4 Admin Template &amp; UI Framework created by pixelcave and published on Themeforest">
	<meta name="author" content="pixelcave">
	<meta name="robots" content="noindex, nofollow">

	<!-- CSRF Token -->
	<meta name="csrf-token" content="{{ csrf_token() }}">

	<!-- Icons -->
	<link rel="shortcut icon" href="{{ asset('media/favicons/favicon.png') }}">
	<link rel="icon" sizes="192x192" type="image/png" href="{{ asset('media/favicons/favicon-192x192.png') }}">
	<link rel="apple-touch-icon" sizes="180x180" href="{{ asset('media/favicons/apple-touch-icon-180x180.png') }}">

	<!-- Fonts and Styles -->
	<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Nunito+Sans:300,400,400i,600,700">
	<link rel="stylesheet" id="css-main" href="{{ asset('/css/codebase.css') }}">

	<link rel="stylesheet" id="css-main" href="{{ asset('js/plugins/sweetalert2/sweetalert2.min.css') }}">
	@yield('css')
	<!-- Select2 -->
	<link rel="stylesheet" href="{{  asset('js/plugins/select2/css/select2.min.css') }}">
	<!-- Scripts -->
	<script>
	window.Laravel = {!! json_encode(['csrfToken' => csrf_token()]) !!};
	</script>