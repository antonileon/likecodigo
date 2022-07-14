<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">

    <title>Codebase - Bootstrap 4 Admin Template &amp; UI Framework</title>

    <meta name="description" content="Codebase - Bootstrap 4 Admin Template &amp; UI Framework created by pixelcave and published on Themeforest">
    <meta name="author" content="pixelcave">
    <meta name="robots" content="noindex, nofollow">

    <!-- Open Graph Meta -->
    <meta property="og:title" content="Codebase - Bootstrap 4 Admin Template &amp; UI Framework">
    <meta property="og:site_name" content="Codebase">
    <meta property="og:description" content="Codebase - Bootstrap 4 Admin Template &amp; UI Framework created by pixelcave and published on Themeforest">
    <meta property="og:type" content="website">
    <meta property="og:url" content="">
    <meta property="og:image" content="">
    <link rel="shortcut icon" href="{{ asset('media/favicons/favicon.png') }}">
    <link rel="icon" type="image/png" sizes="192x192" href="{{ asset('media/favicons/favicon-192x192.png') }}">
    <link rel="apple-touch-icon" sizes="180x180" href="{{ asset('media/favicons/apple-touch-icon-180x180.png') }}">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Nunito+Sans:300,400,400i,600,700&display=swap">
    <link rel="stylesheet" id="css-main" href="{!! asset('css/codebase.css') !!}">
  </head>
  <body>
    <div id="page-container" class="main-content-boxed">
      <main id="main-container">
        <!-- Page Content -->
        <div class="hero bg-white">
          <div class="hero-inner">
            <div class="content content-full">
              <div class="py-30 text-center">
                <div class="display-3 text-corporate">
                  <i class="fa fa-ban"></i> 403
                </div>
                <h1 class="h2 font-w700 mt-30 mb-10">Oops.. Acabas de encontrar una página de error..</h1>
                <h2 class="h3 font-w400 text-muted mb-50">Lo sentimos pero no tienes permiso para acceder a esta página.</h2>
                <a class="btn btn-hero btn-rounded btn-alt-secondary" href="{{ route('home') }}">
                  <i class="fa fa-arrow-left mr-10"></i> Ir al dashboard
                </a>
              </div>
            </div>
          </div>
        </div>
        <!-- END Page Content -->
      </main>
      <!-- END Main Container -->
    </div>
    <script src="{{ asset('js/codebase.core.min.js') }}"></script>
    <script src="{{ asset('js/codebase.app.min.js') }}"></script>
  </body>
</html>