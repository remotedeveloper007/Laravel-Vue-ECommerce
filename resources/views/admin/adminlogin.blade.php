<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Admin Login') }}</title>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <!-- <link href="{{ asset('css/admin.css') }}" rel="stylesheet"> -->
    <style type="text/css">
       /* body { background-image: url('../img/bg-login.jpg') !important;} */
       body { background-image: url('/assets/admin/default/bg-login.jpg') !important;}
       #link { text-decoration: none; background-color: transparent;}
    </style>
</head>
<body class="hold-transition login-page">
    <div id="admin">
        <main class="py-4">
            @yield('content')
            
        </main>
    </div>

<!--===============================================================================================-->
        <!-- <script src="{{asset('assets/admin/js/popper.min.js')}}"></script> -->
    <!-- Scripts -->
    <!-- <script src="{{ asset('js/admin.js') }}" defer></script> -->
 <!--===============================================================================================-->
</body>
</html>
