<!DOCTYPE html>
<html prefix="og: http://ogp.me/ns#" lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta property="og:site_name" content="Agence immobilière Hossegor"/>
@yield('seo')
<!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous">
    <link rel="stylesheet" href='https://code.jquery.com/ui/1.12.1/themes/smoothness/jquery-ui.css'>
    <link href="{{ asset('css/frontend_gl.css') }}?t=<?= time() ?>" rel="stylesheet">
    <link href="{{ asset('css/frontend_sc.css') }}?t=<?= time() ?>" rel="stylesheet">
    <link rel="icon" type="image/png" href="{{ url('storage/app/public/favicon.ico') }}" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.min.css">
    @yield('css')
    <link href="{{ asset('css/select2.css') }}" rel="stylesheet">
    @yield('headjs')
    {{--    <script async src="https://www.googletagmanager.com/gtag/js?id=UA-179163814-1"></script>--}}
    {{--    <script>--}}
    {{--        window.dataLayer = window.dataLayer || [];--}}
    {{--        function gtag(){dataLayer.push(arguments);}--}}
    {{--        gtag('js', new Date());--}}

    {{--        gtag('config', 'UA-179163814-1');--}}
    {{--    </script>--}}
</head>
<body>
@include('layouts.header')
<div class="container-fluid" style="padding: 0;">
    @yield('content')
    <footer>
        @include('layouts.footer')
    </footer>
    @include('layouts.modal')
    @yield('modal')
    </div>
{{--    @include('layouts.backtotop')--}}
    {{--    @if($cookie_rgpd == 0)--}}
    {{--        @include('layouts.cookies')--}}
    {{--    @endif--}}
    {{--    <span id="route_for_register_rgpd_cookies" style="display: none">{{ route('ajax.acceptationCookies') }}</span>--}}
</div>
<script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.min.js" integrity="sha384-Atwg2Pkwv9vp0ygtn1JAojH0nYbwNJLPhwyoVbhoPwBhjQPR5VtM2+xf0Uwh9KtT" crossorigin="anonymous"></script>
<script src="{{ asset('js/jqueryui.js') }}"></script>
@yield('js')
<script src="{{ asset('js/frontend_sc.js') }}?t=<?= time() ?>"></script>
<script src="{{ asset('js/frontend_gl.js') }}?t=<?= time() ?>"></script>
</body>
</html>
