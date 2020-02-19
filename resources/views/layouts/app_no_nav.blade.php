<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'MXC') }}</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>
    <script src="https://unpkg.com/popper.js@1.12.6/dist/umd/popper.js" integrity="sha384-fA23ZRQ3G/J53mElWqVJEGJzU0sTs+SvzG8fXVWP+kJQ1lwFAOkcUOysnlKJC33U" crossorigin="anonymous"></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Roboto:300&display=swap" rel="stylesheet">

    <!-- Styles -->
    <link rel="stylesheet" href="https://unpkg.com/bootstrap-material-design@4.1.1/dist/css/bootstrap-material-design.min.css" integrity="sha384-wXznGJNEXNG1NFsbm0ugrLFMQPWswR3lds2VeinahP8N0zJw9VWSopbjv2x7WCvX" crossorigin="anonymous">
    <!--<link href="{{ asset('css/app.css') }}" rel="stylesheet">-->
    <style>
        body { font-family: 'Roboto', sans-serif; }
        .spacing {
            padding-top: 20px;
        }
        @media only screen and (max-width: 992px) {
            .btn-mobile {
                width: 100%;
                margin-bottom: 10px;
            }
        }
        @media only screen and (min-width: 992px) {
            .spacing {
                padding-top: 10%;
            }
            .btn-mobile {
                width:;
            }
        }

        input:not([type=submit]) {
            padding-left: 10px;
        }
    </style>
</head>
<body style="">
    @yield('content')
</body>
</html>
