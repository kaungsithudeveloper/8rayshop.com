<!DOCTYPE html>
<html class="no-js" lang="en">

<head>
    <meta charset="utf-8" />
    <title>8 Ray Shop</title>
    <meta http-equiv="x-ua-compatible" content="ie=edge" />
    <meta name="description" content="8Ray - Your one-stop shop for Lighting and Accessories, Microphones, Microphone stands and desk setup stands, Tripods & Selfie Sticks, Stabilizers, Product Photography Accessories, GoPro & Accessories, Sound Products, IT Gadgets, and CCTV equipment." />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <meta property="og:title" content="8Ray - Lighting and Accessories, IT Gadgets, Sound Products, and More" />
    <meta property="og:type" content="website" />
    <meta property="og:url" content="https://www.8rayshop.com" />
    <meta property="og:image" content="https://www.yourshopdomain.com/path-to-your-image.jpg" />
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <!-- Favicon -->
    <link rel="shortcut icon" type="image/x-icon" href="{{ url('frontend/8ray/imgs/theme/logo-darks2.png') }}" />

    <!-- Template CSS -->
    <link rel="stylesheet" href="{{ url('frontend/8ray/css/plugins/animate.min.css') }}" />
    <link rel="stylesheet" href="{{ url('frontend/8ray/css/main.css') }}" />
    <link rel="stylesheet" href="{{ url('frontend/8ray/css/plugins/slider-range.css') }}" />
    <!-- View Message CSS-->
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
</head>

<body>
    <!-- Modal -->

    <!-- Quick view -->
    @include('frontend.8ray.layout.quick_view')

    <!-- Header  -->

    @include('frontend.8ray.layout.header')

    @include('frontend.8ray.layout.mobile_header ')

    <!--End header-->

    @yield('8ray')

    @include('frontend.8ray.layout.footer')

    <!-- Preloader Start -->

    @include('frontend.8ray.layout.loader')

    <!-- Vendor JS-->

    <script src="{{ url('frontend/8ray/js/vendor/modernizr-3.6.0.min.js') }}"></script>
    <script src="{{ url('frontend/8ray/js/vendor/jquery-3.6.0.min.js') }}"></script>
    <script src="{{ url('frontend/8ray/js/vendor/jquery-migrate-3.3.0.min.js') }}"></script>
    <script src="{{ url('frontend/8ray/js/vendor/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ url('frontend/8ray/js/plugins/slick.js') }}"></script>
    <script src="{{ url('frontend/8ray/js/plugins/jquery.syotimer.min.js') }}"></script>
    <script src="{{ url('frontend/8ray/js/plugins/waypoints.js') }}"></script>
    <script src="{{ url('frontend/8ray/js/plugins/wow.js') }}"></script>
    <script src="{{ url('frontend/8ray/js/plugins/perfect-scrollbar.js') }}"></script>
    <script src="{{ url('frontend/8ray/js/plugins/magnific-popup.js') }}"></script>
    <script src="{{ url('frontend/8ray/js/plugins/select2.min.js') }}"></script>
    <script src="{{ url('frontend/8ray/js/plugins/counterup.js') }}"></script>
    <script src="{{ url('frontend/8ray/js/plugins/jquery.countdown.min.js') }}"></script>
    <script src="{{ url('frontend/8ray/js/plugins/images-loaded.js') }}"></script>
    <script src="{{ url('frontend/8ray/js/plugins/isotope.js') }}"></script>
    <script src="{{ url('frontend/8ray/js/plugins/scrollup.js') }}"></script>
    <script src="{{ url('frontend/8ray/js/plugins/jquery.vticker-min.js') }}"></script>
    <script src="{{ url('frontend/8ray/js/plugins/jquery.theia.sticky.js') }}"></script>
    <script src="{{ url('frontend/8ray/js/plugins/jquery.elevatezoom.js') }}"></script>
    <script src="{{ url('frontend/8ray/js/plugins/leaflet.js') }}"></script>
    <!-- Template  JS -->
    <script src="{{ url('frontend/8ray/js/main.js') }}"></script>
    <script src="{{ url('frontend/8ray/js/shop.js') }}"></script>

    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>

    <script>

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

        @if (Session::has('message'))
            var type = "{{ Session::get('alert-type', 'info') }}"
            switch (type) {
                case 'info':
                    toastr.info(" {{ Session::get('message') }} ");
                    break;
                case 'success':
                    toastr.success(" {{ Session::get('message') }} ");
                    break;
                case 'warning':
                    toastr.warning(" {{ Session::get('message') }} ");
                    break;
                case 'error':
                    toastr.error(" {{ Session::get('message') }} ");
                    break;
            }
        @endif
    </script>

    <script type="text/javascript">

        $.ajaxSetup({
            headers:{
                'X-CSRF-TOKEN':$('meta[name="csrf-token"]').attr('centent')
            }
        })
        /// Start product view with Modal
    </script>

    @stack('scripts')
</body>

</html>
