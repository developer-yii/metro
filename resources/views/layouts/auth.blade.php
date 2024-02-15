@php
    $baseUrl = asset('backend')."/";
@endphp
<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- App favicon -->
    <link rel="shortcut icon" href="{{$baseUrl}}images/favicon.ico">

    <!-- Theme Config Js -->
    <script src="{{$baseUrl}}js/hyper-config.js"></script>

    <!-- App css -->
    <link href="{{$baseUrl}}css/app-saas.min.css" rel="stylesheet" type="text/css" id="app-style" />

    <!-- Icons css -->
    <link href="{{$baseUrl}}css/icons.min.css" rel="stylesheet" type="text/css" />

    <!-- Scripts -->
</head>

<body class="authentication-bg">
    <div class="account-pages pt-2 pt-sm-5 pb-4 pb-sm-5">

        @yield('content')

    </div>

    <footer class="footer footer-alt">
        2018 - <script>document.write(new Date().getFullYear())</script> © {{ env('APP_NAME') }}
    </footer>

    <!-- Vendor js -->
    <script src="{{$baseUrl}}js/vendor.min.js"></script>

    <!-- App js -->
    <script src="{{$baseUrl}}js/app.min.js"></script>

</body>
</html>
