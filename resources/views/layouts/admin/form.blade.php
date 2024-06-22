<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link href="{{ asset('/img/logo_undip.png') }}" rel="icon">

    <!-- Font special for pages-->
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i,800,800i"
        rel="stylesheet">

    <!-- Font Awesome -->
    <link rel="stylesheet" href="{{ asset('lte/plugins/fontawesome-free/css/all.min.css') }}">

    <!-- From Only CSS-->
    <link href="{{ asset('form/css/main.css') }}" rel="stylesheet" media="all">
   

    <title>Portofolio App</title>

    @yield('extra-css')

    @yield('inline-css')

</head>

<body>

    <section>
        @yield('form_only')
    </section>

    <!-- Jquery JS for Form Only-->
    <script src="{{ asset('form/vendor/jquery/jquery.min.js') }}"></script>

    <!-- Form Only JS -->
    <script src="{{ asset('form/js/global.js') }}"></script>

    @yield('extra-package')
    
    @yield('inlinejs')
    </div>
</body>

</html>
