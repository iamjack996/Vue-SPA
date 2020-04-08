<!DOCTYPE html>
<html lang="en">
<head>
    <title>首頁</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <link href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700,800,900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="{{ asset('https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css') }}">

    <link rel="stylesheet" href="{{ asset('package/homebuilder/css/animate.css') }}">
    <link rel="stylesheet" href="{{ asset('package/homebuilder/css/owl.carousel.min.css') }}">
    <link rel="stylesheet" href="{{ asset('package/homebuilder/css/owl.theme.default.min.css') }}">
    <link rel="stylesheet" href="{{ asset('package/homebuilder/css/magnific-popup.css') }}">
    <link rel="stylesheet" href="{{ asset('package/homebuilder/css/ionicons.min.css') }}">

    <link rel="stylesheet" href="{{ asset('package/homebuilder/css/flaticon.css') }}">
    <link rel="stylesheet" href="{{ asset('package/homebuilder/css/icomoon.css') }}">
    <link rel="stylesheet" href="{{ asset('package/homebuilder/css/style.css') }}">

    @yield('head')
</head>
<body>

@include('test.layouts.header')
<!-- END nav -->

@yield('content')

@include('test.layouts.footer')

<!-- loader -->
<div id="ftco-loader" class="show fullscreen"><svg class="circular" width="48px" height="48px"><circle class="path-bg" cx="24" cy="24" r="22" fill="none" stroke-width="4" stroke="#eeeeee"/><circle class="path" cx="24" cy="24" r="22" fill="none" stroke-width="4" stroke-miterlimit="10" stroke="#F96D00"/></svg></div>

<script src="{{ asset('/js/vue.js') }}"></script>

@yield('script')

{{--<script src="{{ asset('package/homebuilder/js/jquery.min.js') }}"></script>--}}
<script src="{{ asset('package/homebuilder/js/jquery-migrate-3.0.1.min.js') }}"></script>
<script src="{{ asset('package/homebuilder/js/popper.min.js') }}"></script>
<script src="{{ asset('package/homebuilder/js/bootstrap.min.js') }}"></script>
<script src="{{ asset('package/homebuilder/js/jquery.easing.1.3.js') }}"></script>
<script src="{{ asset('package/homebuilder/js/jquery.waypoints.min.js') }}"></script>
<script src="{{ asset('package/homebuilder/js/jquery.stellar.min.js') }}"></script>
<script src="{{ asset('package/homebuilder/js/jquery.animateNumber.min.js') }}"></script>
<script src="{{ asset('package/homebuilder/js/owl.carousel.min.js') }}"></script>
<script src="{{ asset('package/homebuilder/js/jquery.magnific-popup.min.js') }}"></script>
<script src="{{ asset('package/homebuilder/js/scrollax.min.js') }}"></script>
<script src="{{ asset('https://maps.googleapis.com/maps/api/js?key=AIzaSyBVWaKrjvy3MaE7SQ74_uJiULgl1JY0H2s&sensor=false') }}"></script>
<script src="{{ asset('package/homebuilder/js/google-map.js') }}"></script>
<script src="{{ asset('package/homebuilder/js/main.js') }}"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@9"></script>

@yield('afterJs')

</body>
</html>
