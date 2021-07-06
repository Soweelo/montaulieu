<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    @yield('seo')

    <meta name="csrf-token" content="{{ csrf_token() }}">
    <!-- Bootstrap CSS -->
    <link href='{{ asset('css/bootstrap-flatly.min.css') }}' rel="stylesheet">
    <link rel="stylesheet" href='https://code.jquery.com/ui/1.12.1/themes/smoothness/jquery-ui.css'>
    <link rel="stylesheet" href="{{ asset('js/fancybox/dist/jquery.fancybox.min.css') }}" type="text/css" media="screen" />
    <link href='{{ asset('css/admin_sc.css') }}' rel="stylesheet">
    <link href='{{ asset('css/admin_gl.css') }}' rel="stylesheet">
    @yield('css')
    <title>Commune de Montaulieu</title>
</head>

<body>
@include('layouts.navadmin')
<div class='container-fluid' style="margin-top: 25px;">
    @include('layouts.flash')
    @yield('content')
</div>
@include('layouts.modal_admin')

<script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.min.js" integrity="sha384-Atwg2Pkwv9vp0ygtn1JAojH0nYbwNJLPhwyoVbhoPwBhjQPR5VtM2+xf0Uwh9KtT" crossorigin="anonymous"></script>
<script src="{{ asset('js/laravel.js') }}" ></script>
<script src="{{ asset('js/jqueryui.js') }}" ></script>
<script type="text/javascript" src="{{ asset('js/fancybox/dist/jquery.fancybox.min.js') }}"></script>
@yield('js')
</body>
</html>
