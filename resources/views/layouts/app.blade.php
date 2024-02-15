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

    <title>@yield('title') {{ config('app.name', 'Laravel') }}</title>

    <!-- App css -->
    @include('layouts.partial.link')

    @yield('css')
</head>
<body>
    <!-- Begin page -->
    <div class="wrapper">

        @include('layouts.partial.navbar')

        @include('layouts.partial.sidebar')

        <!-- Start Page Content here -->
        <div class="content-page">
            @yield('content')

            @include('layouts.partial.footer')
        </div>
        <!-- End Page content -->

    </div>
    <!-- END wrapper -->

    @include('layouts.partial.theme_setting')
    @include('layouts.partial.script')

    @yield('script')

</body>
</html>
