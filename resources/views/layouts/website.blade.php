<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="icon" type="image/x-icon" href="{{ file_url(setting('favicon')) }}">
    {!! SEO::generate() !!}
    <link rel="canonical" href="{{ request()->url() }}" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.9.1/font/bootstrap-icons.css">
    <link rel="stylesheet" type="text/css" href="{{ asset('vendor/cookie-consent/css/cookie-consent.css') }}">
    <!-- Scripts -->
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])
    <!-- <link rel="stylesheet" href="{{ asset('build/assets/app.d6927e34.css') }}" />
    <script type="module" src="{{asset('build/assets/app.60ff3029.js')}}"></script> -->

    <!-- Custom CSS -->
    @stack('styles')

    <!-- Custom Js-->
    @stack('recaptcha')

    @livewireStyles
</head>

<body>
    <div id="app">
        <!-- Header -->
        @include('layouts.header')

        <main class="">
            @yield('content')
        </main>

        <!-- Footer -->
        @include('layouts.footer')
        <div id="session" data-success="{{ session('success') }}" data-error="{{ session('error') }}"></div>

        <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
        <script>
            let success = document.getElementById('session').dataset.success;
            let error = document.getElementById('session').dataset.error;
            if (success) {
                Swal.fire(
                    'Congradulations!',
                    success,
                    'success'
                )
            }
            if (error) {
                Swal.fire(
                    'Ooops!',
                    error,
                    'error'
                )
            }
        </script>
        <!-- Custom Js-->
        @stack('scripts')
        <script src="{{ asset('vendor/cookie-consent/js/cookie-consent.js') }}"></script>
        @livewireScripts
    </div>
</body>

</html>
