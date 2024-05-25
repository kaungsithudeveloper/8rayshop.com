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
    <link href="{{ url('backend/css/custom.css') }}" rel="stylesheet" />

    <!--- FONT-ICONS CSS -->
    <link href="{{ url('backend/css/icons.css') }}" rel="stylesheet" />

    <!-- COLOR SKIN CSS -->
    <link id="theme" rel="stylesheet" type="text/css" media="all" href="{{ url('backend/colors/color1.css') }}" />

    <!-- View Message CSS-->
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.css">

    @stack('styles')

    <style>
        .card{
            height: 700px;
        }

        .col-md-6:nth-child(odd) .card:hover {
            background-color: lightblue; /* Change to your desired hover color */
            transform: translateY(-5px); /* Move the card 5px up */
            box-shadow: 0 10px 20px rgba(0, 0, 0, 0.19), 0 6px 6px rgba(0, 0, 0, 0.23);
        }

        /* Style for the second card */
        .col-md-6:nth-child(even) .card:hover {
            background-color: rgb(238, 144, 144); /* Change to your desired hover color */
            transform: translateY(-5px); /* Move the card 5px up */
            box-shadow: 0 10px 20px rgba(0, 0, 0, 0.19), 0 6px 6px rgba(0, 0, 0, 0.23);
        }
    </style>



</head>

<body class="app sidebar-mini ltr">

    <!-- BACKGROUND-IMAGE -->
    <div class="">

        <!-- GLOABAL LOADER -->
        <div id="global-loader">
            <img src="{{ url('backend/images/loader.svg') }}" class="loader-img" alt="Loader">
        </div>
        <!-- /GLOABAL LOADER -->

        <!-- PAGE -->
        <div class="page">
            <div class="">
                <div class="container">
                    <div class="row">
                        <div class="col-md-12 " >

                            @php
                                $id = Auth::user()->id;
                                $employeeData = App\Models\User::find($id);
                            @endphp

                            <!-- Content for the first column -->
                            <div class="d-flex justify-content-between align-items-center" id="pos-logo">
                                <a href="index.html" class="navbar-brand"></a>

                                <div class="dropdown profile-1 justify-content-end pos">
                                    <a href="javascript:void(0)" data-bs-toggle="dropdown" class="nav-link leading-none d-flex">
                                        <img src="{{ (!empty($employeeData->photo))?url('upload/employee_images/'.$employeeData->photo):url('upload/profile.jpg') }}" alt="profile-user" class="avatar profile-user brround cover-image">
                                        <div class="text-center p-2">
                                            <h5 class="text-dark mb-0 fs-14 fw-semibold">{{ Auth::user()->name }}</h5>
                                            <small class="text-muted">{{ Auth::user()->email }}</small>
                                        </div>
                                    </a>

                                    <div class="dropdown-menu dropdown-menu-end dropdown-menu-arrow pt-3">
                                        <a class="dropdown-item" href="{{ route('admin.profile') }}">
                                            <i class="dropdown-icon fe fe-user"></i> Profile
                                        </a>
                                        <a class="dropdown-item" href="{{ route('admin.profile') }}">
                                            <i class="dropdown-icon fe fe-user"></i> Change Password
                                        </a>
                                        <a class="dropdown-item" href="{{ url('employee/logout') }}">
                                            <i class="dropdown-icon fe fe-alert-circle"></i> Sign out
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="container mt-2">
                    <div class="row p-2">

                        <div class="col-md-6 col-xl-6">
                            <a href="{{ route('employee.8ray.dashboard') }}">
                                <div class="card" >
                                    <div class="card-body d-flex align-items-center justify-content-center ">
                                        <img src="{{ url('backend/images/brand/logo-darks.png') }}">
                                    </div>
                                </div>
                            </a>
                        </div>

                        <div class="col-md-6 col-xl-6">
                            <a href="{{ route('employee.datacentre.dashboard') }}">
                                <div class="card">
                                    <div class="card-body d-flex align-items-center justify-content-center">
                                        <img src="{{ url('backend/images/brand/datacentre-dark.png') }}">
                                    </div>
                                </div>
                            </a>
                        </div>

                    </div>
                </div>

                <div class="container pt-4">
                    <div class="row align-items-center flex-row-reverse">
                        <div class="col-md-12 col-sm-12 text-center">
                            Copyright © <span id="year"></span>
                            <a href="javascript:void(0)">8Ray</a>. Designed with
                            <span class="fa fa-heart text-danger"></span> by
                            <a href="javascript:void(0)"> Kaung Si Thu </a> All rights reserved.
                        </div>
                    </div>
                </div>

                <!-- CONTAINER CLOSED -->
            </div>
        </div>
        <!-- End PAGE -->

    </div>
    <!-- BACKGROUND-IMAGE CLOSED -->

    <!-- JQUERY JS -->
    <script src="{{ url('backend/js/jquery.min.js') }}"></script>

    <!-- BOOTSTRAP JS -->
    <script src="{{ url('backend/plugins/bootstrap/js/popper.min.js') }}"></script>
    <script src="{{ url('backend/plugins/bootstrap/js/bootstrap.min.js') }}"></script>

    <!-- SHOW PASSWORD JS -->
    <script src="{{ url('backend/js/show-password.min.js') }}"></script>

    <!-- GENERATE OTP JS -->
    <script src="{{ url('backend/js/generate-otp.js') }}"></script>

    <!-- Perfect SCROLLBAR JS-->
    <script src="{{ url('backend/plugins/p-scroll/perfect-scrollbar.js') }}"></script>

    <!-- Color Theme js -->
    <script src="{{ url('backend/js/themeColors.js') }}"></script>

    <!-- CUSTOM JS -->
    <script src="{{ url('backend/js/custom.js') }}"></script>

    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>

    <script>
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

    @stack('scripts')

</body>

</html>
