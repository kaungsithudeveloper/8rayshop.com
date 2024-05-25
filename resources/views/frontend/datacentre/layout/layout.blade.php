<!DOCTYPE html>
<html class="no-js" lang="en">

<head>
    <meta charset="utf-8" />
    <title>Nest - Multipurpose eCommerce HTML Template</title>
    <meta http-equiv="x-ua-compatible" content="ie=edge" />
    <meta name="description" content="" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <meta property="og:title" content="" />
    <meta property="og:type" content="" />
    <meta property="og:url" content="" />
    <meta property="og:image" content="" />
    <!-- Favicon -->
    <link rel="shortcut icon" type="image/x-icon" href="{{ url('frontend/8ray/imgs/theme/favicon.svg') }}" />
    <!-- Template CSS -->
    <link rel="stylesheet" href="{{ url('frontend/8ray/css/plugins/animate.min.css') }}" />
    <link rel="stylesheet" href="{{ url('frontend/8ray/css/main.css') }}" />
</head>

<body>
    <!-- Modal -->

    <!-- Quick view -->
    @include('frontend.datacentre.layout.quick_view')

    <!-- Header  -->

    @include('frontend.datacentre.layout.header')

    @include('frontend.datacentre.layout.mobile_header')

    <!--End header-->

    @yield('datacentre')

    @include('frontend.datacentre.layout.footer')

    <!-- Preloader Start -->

    @include('frontend.datacentre.layout.loader')

    <!-- Vendor JS-->

    <script src="{{ url('frontend/8ray/js/vendor/modernizr-3.6.0.min.js') }}"></script>
    <script src="{{ url('frontend/8ray/js/vendor/jquery-3.6.0.min.js') }}"></script>
    <script src="{{ url('frontend/8ray/js/vendor/jquery-migrate-3.3.0.min.js') }}"></script>
    <script src="{{ url('frontend/8ray/js/vendor/bootstrap.bundle.min.j') }}s"></script>
    <script src="{{ url('frontend/8ray/js/plugins/slick.js') }}"></script>
    <script src="{{ url('frontend/8ray/js/plugins/jquery.syotimer.min.js') }}"></script>
    <script src="{{ url('frontend/8ray/js/plugins/waypoints.js') }}"></script>
    <script src="{{ url('frontend/8ray/js/plugins/wow.j') }}s"></script>
    <script src="{{ url('frontend/8ray/js/plugins/perfect-scrollbar.js') }}"></script>
    <script src="{{ url('frontend/8ray/js/plugins/magnific-popup.j') }}s"></script>
    <script src="{{ url('frontend/8ray/js/plugins/select2.min.js') }}"></script>
    <script src="{{ url('frontend/8ray/js/plugins/counterup.js') }}"></script>
    <script src="{{ url('frontend/8ray/js/plugins/jquery.countdown.min.js') }}"></script>
    <script src="{{ url('frontend/8ray/js/plugins/images-loaded.js') }}"></script>
    <script src="{{ url('frontend/8ray/js/plugins/isotope.js') }}"></script>
    <script src="{{ url('frontend/8ray/js/plugins/scrollup.js') }}"></script>
    <script src="{{ url('frontend/8ray/js/plugins/jquery.vticker-min.js') }}"></script>
    <script src="{{ url('frontend/8ray/js/plugins/jquery.theia.sticky.j') }}s"></script>
    <script src="{{ url('frontend/8ray/js/plugins/jquery.elevatezoom.js') }}"></script>
    <!-- Template  JS -->
    <script src="{{ url('frontend/8ray/js/main.js') }}"></script>
    <script src="{{ url('frontend/8ray/js/shop.js') }}"></script>
</body>

</html>
