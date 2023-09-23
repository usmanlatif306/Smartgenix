<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="icon" type="image/x-icon" href="{{ file_url(setting('favicon')) }}">
    <title>{{ setting('app_name') }}</title>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet">

    <!-- Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.9.1/font/bootstrap-icons.css">

    <!-- Styles -->
    <link rel="stylesheet" href="{{ asset('css/custom.css') }}">
    <!-- Scripts -->
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])
    <!-- <link rel="stylesheet" href="{{ asset('build/assets/app.d6927e34.css') }}" />
    <script type="module" src="{{asset('build/assets/app.60ff3029.js')}}"></script> -->
    @stack('styles')
    @livewireStyles
</head>

<body>
    <div id="app">
        @include('layouts.auth_header')

        <main class="py-4">
            @if (on_trial() &&
                    !request()->user()->active_subscription())
                <div class="container page-container">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="alert alert-danger">Your trial period will end after
                                {{ now()->diffInDays(auth()->user()->trial_ends_at) }} days.</div>
                        </div>
                    </div>
                </div>
            @endif

            @yield('content')
        </main>

        <!-- footer -->
        {{-- <footer class="footer p-2">
            <span class="text-muted text-center text-sm-left d-block d-sm-inline-block">Copyright ©
                {{ now()->format('Y') }}.
        <a href="http://smartgenix.co.uk/" target="_blank">{{ config('app.name') }}</a>
        All rights reserved.</span>
        </footer> --}}
        <!-- footer end-->
    </div>
    <script src="https://kit.fontawesome.com/2cf4d7f403.js" crossorigin="anonymous"></script>
    @stack('scripts')
    @livewireScripts

</body>

</html>
