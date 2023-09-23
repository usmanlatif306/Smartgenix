<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="csrf-token" content="{{ csrf_token() }}" />

    <title>{{ config('app.name', 'Laravel') }}</title>
    <link rel="icon" type="image/x-icon" href="{{ file_url(setting('favicon')) }}">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="{{ asset('css/sb-admin-2.min.css') }}" rel="stylesheet">
    <style>
        .bg-gradient-primary {
            background-color: #1d345e;
            background-image: linear-gradient(180deg, #1d345e 10%, #1d345e 100%);
            background-size: cover;
        }

        .btn-primary {
            background-color: #1d345e !important;
            color: white !important;
            border-color: #1d345e !important;
        }

        .btn-primary:hover {
            background-color: #0c2e6d !important;
        }

        .text-genix,
        .text-gray-900,
        .small {
            color: #1d345e !important;
        }

        .bg-login-image {
            background: url("{{ file_url(setting('login_image')) }}");
            background-position: center;
            background-size: contain;
        }
    </style>
</head>

<body class="bg-gradient-primary">
    <div class="container">
        @yield('content')
    </div>
</body>

</html>
