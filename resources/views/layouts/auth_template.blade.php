<!DOCTYPE html>
<html lang="en">


<!-- login23:11-->
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0">
    <link rel="shortcut icon" type="image/x-icon" href="/img/favicon.ico">
    <title>Dental Clinic</title>
    <link rel="stylesheet" type="text/css" href="/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="/css/font-awesome.min.css">
    <link rel="stylesheet" type="text/css" href="/css/style.css">
    <meta name="csrf-token" content="{{ csrf_token() }}">


    <script src="{{ asset('js/vendor/jquery.js') }}" defer></script>
    <script src="{{ asset('js/vendor/foundation.min.js') }}" defer></script>

    <script src="{{ asset('js/app.js') }}" defer></script>

</head>

<body>
<div class="main-wrapper account-wrapper">
    @yield('content')
</div>
<script src="/js/jquery-3.2.1.min.js"></script>
<script src="/js/popper.min.js"></script>
<script src="/js/bootstrap.min.js"></script>
@stack('custom_scripts')
<script src="/js/template.js"></script>
</body>


<!-- login23:12-->
</html>
