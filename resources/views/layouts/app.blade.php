<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    @include('layouts.css')
</head>
<body>
    <div id="page-container" class="sidebar-o sidebar-dark enable-page-overlay side-scroll page-header-fixed page-header-dark main-content-boxed">
        @include('sweetalert::alert')
        @include('layouts.sidebar_right')
        @include('layouts.sidebar')
        @include('layouts.header')
        <main id="main-container">
            @yield('content')
        </main>
        @include('layouts.footer')
    </div>
    @include('layouts.scripts')
</body>
</html>
