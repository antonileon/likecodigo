<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <title>{{ config('app.name') }} | @yield('title')</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">

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

    <!-- Icons -->
    <!-- The following icons can be replaced with your own, they are used by desktop and mobile browsers -->
    <link rel="shortcut icon" href="assets/media/favicons/favicon.png">
    <link rel="icon" type="image/png" sizes="192x192" href="assets/media/favicons/favicon-192x192.png">
    <link rel="apple-touch-icon" sizes="180x180" href="assets/media/favicons/apple-touch-icon-180x180.png">
    <!-- END Icons -->

    <!-- Stylesheets -->

    <!-- Fonts and Codebase framework -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Muli:300,400,400i,600,700">
    <link rel="stylesheet" id="css-main" href="{!! asset('css/codebase.css') !!}">

    <!-- You can include a specific file from css/themes/ folder to alter the default color theme of the template. eg: -->
    <!-- <link rel="stylesheet" id="css-theme" href="assets/css/themes/flat.min.css"> -->
    <!-- END Stylesheets -->
</head>
<body>
    <div id="page-container" class="main-content-boxed">
        <!-- Main Container -->
        <main id="main-container">
            <!-- Page Content -->
            @yield('content')           
        </main>
    </div>
    <!--
        Codebase JS Core

        Vital libraries and plugins used in all pages. You can choose to not include this file if you would like
        to handle those dependencies through webpack. Please check out assets/_es6/main/bootstrap.js for more info.

        If you like, you could also include them separately directly from the assets/js/core folder in the following
        order. That can come in handy if you would like to include a few of them (eg jQuery) from a CDN.

        assets/js/core/jquery.min.js
        assets/js/core/bootstrap.bundle.min.js
        assets/js/core/simplebar.min.js
        assets/js/core/jquery-scrollLock.min.js
        assets/js/core/jquery.appear.min.js
        assets/js/core/jquery.countTo.min.js
        assets/js/core/js.cookie.min.js
    -->

    <!--
        Codebase JS

        Custom functionality including Blocks/Layout API as well as other vital and optional helpers
        webpack is putting everything together at assets/_es6/main/app.js
    -->
    <script src="{!! asset('js/codebase.app.js') !!}"></script>

    <!-- Page JS Plugins -->
    <script src="{!! asset('js/plugins/jquery-validation/jquery.validate.min.js') !!}"></script>

    <!-- Page JS Code -->
    <script src="{!! asset('js/pages/op_auth_signin.min.js') !!}"></script>
</body>
</html>
