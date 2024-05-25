<!doctype html>
<html lang="en" dir="ltr">

<head>

    <!-- META DATA -->
    <meta charset="UTF-8">
    <meta name='viewport' content='width=device-width, initial-scale=1.0, user-scalable=0'>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="description" content="Sash – Bootstrap 5  Admin & Dashboard Template">
    <meta name="author" content="Spruko Technologies Private Limited">
    <meta name="keywords" content="admin,admin dashboard,admin panel,admin template,bootstrap,clean,dashboard,flat,jquery,modern,responsive,premium admin templates,responsive admin,ui,ui kit.">

    <!-- FAVICON -->
    <link rel="shortcut icon" type="image/x-icon" href="{{ url('backend/images/brand/favicon.ico') }}" />

    <!-- TITLE -->
    <title>8Ray</title>

    <!-- BOOTSTRAP CSS -->
    <link id="style" href="{{ url('backend/plugins/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet" />

    <!-- STYLE CSS -->
    <link href="{{ url('backend/css/style.css') }}" rel="stylesheet" />
    <link href="{{ url('backend/css/dark-style.css') }}" rel="stylesheet" />
    <link href="{{ url('backend/css/transparent-style.css') }}" rel="stylesheet">
    <link href="{{ url('backend/css/skin-modes.css') }}" rel="stylesheet" />

    <!--- FONT-ICONS CSS -->
    <link href="{{ url('backend/css/icons.css') }}" rel="stylesheet" />

    <!-- COLOR SKIN CSS -->
    <link id="theme" rel="stylesheet" type="text/css" media="all" href="{{ url('backend/colors/color1.css') }}" />


</head>

<body class="app sidebar-mini ltr light-mode">


    <!-- GLOBAL-LOADER -->
    @include('backend.employees.layout.apploader')
    <!-- /GLOBAL-LOADER -->

    <!-- PAGE -->
    <div class="page">
        <div class="page-main">

            <!-- app-Header -->
            @include('backend.employees.layout.appheader')
            <!-- /app-Header -->

            <!--APP-SIDEBAR-->
            @include('backend.employees.layout.appsidebar_8ray')

            <!--app-content open-->
            @yield('employee')
            <!--app-content closed-->
        </div>

        <!-- Sidebar-right -->
        @include('backend.employees.layout.apprsidebar')
        <!--/Sidebar-right-->

        <!-- FOOTER -->
        @include('backend.employees.layout.appfooter')
        <!-- FOOTER CLOSED -->
    </div>

    <!-- BACK-TO-TOP -->
    <a href="#top" id="back-to-top"><i class="fa fa-angle-up"></i></a>

    <!-- JQUERY JS -->
    <script src="{{ url('backend/js/jquery.min.js') }}"></script>

    <!-- BOOTSTRAP JS -->
    <script src="{{ url('backend/plugins/bootstrap/js/popper.min.js') }}"></script>
    <script src="{{ url('backend/plugins/bootstrap/js/bootstrap.min.js') }}"></script>

    <!-- SIDE-MENU JS -->
    <script src="{{ url('backend/plugins/sidemenu/sidemenu.js') }}"></script>

	<!-- TypeHead js -->
	<script src="{{ url('backend/plugins/bootstrap5-typehead/autocomplete.js') }}"></script>
    <script src="{{ url('backend/js/typehead.js') }}"></script>

    <!-- SIDEBAR JS -->
    <script src="{{ url('backend/plugins/sidebar/sidebar.js') }}"></script>

    <!-- Perfect SCROLLBAR JS-->
    <script src="{{ url('backend/plugins/p-scroll/perfect-scrollbar.js') }}"></script>
    <script src="{{ url('backend/plugins/p-scroll/pscroll.js') }}"></script>
    <script src="{{ url('backend/plugins/p-scroll/pscroll-1.js') }}"></script>

    <!-- Color Theme js -->
    <script src="{{ url('backend/js/themeColors.js') }}"></script>

    <!-- Sticky js -->
    <script src="{{ url('backend/js/sticky.js') }}"></script>

    <!-- CUSTOM JS -->
    <script src="{{ url('backend/js/custom1.js') }}"></script>


</body>

</html>
