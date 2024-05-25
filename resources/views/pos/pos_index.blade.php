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
    <link rel="shortcut icon" type="image/x-icon" href="{{ url('backend/images/brand/favicon.ico') }}">

    <!-- TITLE -->
    <title>8Ray | POS</title>

    <!-- BOOTSTRAP CSS -->
    <link id="style" href="{{ url('backend/plugins/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">

    <!-- STYLE CSS -->
     <link href="{{ url('backend/css/style.css') }}" rel="stylesheet">
     <link href="{{ url('backend/css/custom.css') }}" rel="stylesheet">

    <!--- FONT-ICONS CSS -->
    <link href="{{ url('backend/css/icons.css') }}" rel="stylesheet">


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
                            <!-- Content for the first column -->
                            <div class="d-flex justify-content-between align-items-center" id="pos-logo">
                                <a href="index.html" class="navbar-brand">
                                    <img src="{{ url('backend/images/brand/logo-darks.png') }}" class="header-brand-img " alt="logo">
                                </a>

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

                                            <a class="dropdown-item" href="{{ route('employee.page') }}">
                                                <i class="dropdown-icon fe fe-user"></i> Main Page
                                            </a>
                                            @if(Auth::user()->role == 'admin')
                                                <a class="dropdown-item" href="{{ url('admin/logout') }}">
                                                    <i class="dropdown-icon fe fe-alert-circle"></i> Sign out
                                                </a>
                                            @elseif(Auth::user()->role == 'employee')
                                                <a class="dropdown-item" href="{{ url('employee/logout') }}">
                                                    <i class="dropdown-icon fe fe-alert-circle"></i> Sign out
                                                </a>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="container">
                    <div class="row p-2">
                        <div class="col-md-4 col-xl-4">
                            <a href="sale.html">
                                <div class="card bg-primary pt-6 pb-6">
                                    <div class="card-body d-flex align-items-center justify-content-center ">
                                        <span class="shop-for-title text-white">
                                            စျေးရောင်းရန်
                                        </span>
                                    </div>
                                </div>
                            </a>
                        </div>

                        <div class="col-md-4 col-xl-4">
                            <a href="index.html">
                                <div class="card bg-success pt-6 pb-6">
                                    <div class="card-body d-flex align-items-center justify-content-center">
                                        <span class="shop-for-title text-white mx-auto">
                                            ကုန်၀ယ်ပစ္စည်း သွင်းရန်
                                        </span>
                                    </div>
                                </div>
                            </a>

                        </div>

                        <div class="col-md-4 col-xl-4">
                            <a href="index.html">
                                <div class="card bg-danger pt-6 pb-6">
                                    <div class="card-body d-flex align-items-center justify-content-center">
                                        <span class="shop-for-title text-white mx-auto">
                                            ရှာရန်
                                        </span>
                                    </div>
                                </div>
                            </a>
                        </div>
                        <div class="col-md-4 col-xl-4">
                            <a href="index.html">
                                <div class="card bg-pink pt-6 pb-6">
                                    <div class="card-body d-flex align-items-center justify-content-center">
                                        <span class="shop-for-title text-white mx-auto">
                                            ရရန်အကြွေးဆိုင်ရာများ
                                        </span>
                                    </div>
                                </div>
                            </a>
                        </div>
                        <div class="col-md-4 col-xl-4">
                            <a href="index.html">
                                <div class="card bg-orange pt-6 pb-6">
                                    <div class="card-body d-flex align-items-center justify-content-center">
                                        <span class="shop-for-title text-white mx-auto">
                                            ပြန်လည်ပြင်ဆင်ခြင်းဆိုင်ရာများ
                                        </span>
                                    </div>
                                </div>
                            </a>
                        </div>
                        <div class="col-md-4 col-xl-4">
                            <a href="index.html">
                                <div class="card bg-info pt-6 pb-6">
                                    <div class="card-body d-flex align-items-center justify-content-center">
                                        <span class="shop-for-title text-white mx-auto">
                                            စာရင်းချုပ်
                                        </span>
                                    </div>
                                </div>
                            </a>
                        </div>
                        <div class="col-md-4 col-xl-4">
                            <a href="index.html">
                                <div class="card bg-teal pt-6 pb-6">
                                    <div class="card-body d-flex align-items-center justify-content-center">
                                        <span class="shop-for-title text-white mx-auto">
                                            ပေးရန်‌ကြွေးဆိုင်ရာများ
                                        </span>
                                    </div>
                                </div>
                            </a>
                        </div>
                        <div class="col-md-4 col-xl-4">
                            <a href="index.html">
                                <div class="card bg-gray pt-6 pb-6">
                                    <div class="card-body d-flex align-items-center justify-content-center">
                                        <span class="shop-for-title text-white mx-auto">
                                            ငွေစာရင်း
                                        </span>
                                    </div>
                                </div>
                            </a>
                        </div>
                        <div class="col-md-4 col-xl-4">
                            <a href="index.html">
                                <div class="card bg-cyan pt-6 pb-6">
                                    <div class="card-body d-flex align-items-center justify-content-center">
                                        <span class="shop-for-title text-white mx-auto">
                                            ကုန်ပစ္စည်း အ၀င်/အထွက် လက်ကျန်
                                        </span>
                                    </div>
                                </div>
                            </a>
                        </div>
                        <div class="col-md-4 col-xl-4">
                            <a href="index.html">
                                <div class="card bg-warning pt-6 pb-6">
                                    <div class="card-body d-flex align-items-center justify-content-center">
                                        <span class="shop-for-title text-white mx-auto">
                                            ၀န်ထမ်းရေးရာ
                                        </span>
                                    </div>
                                </div>
                            </a>
                        </div>

                        <div class="col-md-4 col-xl-4">
                            <a href="index.html">
                                <div class="card bg-success pt-6 pb-6">
                                    <div class="card-body d-flex align-items-center justify-content-center">
                                        <span class="shop-for-title text-white mx-auto">
                                            ပုံသေပိုင်ပစ္စည်း စာရင်း
                                        </span>
                                    </div>
                                </div>
                            </a>
                        </div>
                        <div class="col-md-4 col-xl-4">
                            <a href="index.html">
                                <div class="card bg-yellow pt-6 pb-6">
                                    <div class="card-body d-flex align-items-center justify-content-center">
                                        <span class="shop-for-title text-white mx-auto">
                                            ရွေးချယ်ပိုင်ခွင့်များ
                                        </span>
                                    </div>
                                </div>
                            </a>
                        </div>
                    </div>
                </div>

                <div class="container pt-4">
                    <div class="row align-items-center flex-row-reverse">
                        <div class="col-md-12 col-sm-12 text-center">
                            Copyright © <span id="year"></span> <a href="javascript:void(0)">8Ray</a>. Designed with <span class="fa fa-heart text-danger"></span> by <a href="javascript:void(0)"> Kaung Si Thu </a> All rights reserved.
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
    <script src="{{ url('backend/plugins/bootstrap/js/popper.min.j') }}s"></script>
    <script src="{{ url('backend/plugins/bootstrap/js/bootstrap.min.js') }}"></script>

    <!-- CUSTOM JS -->
    <script src="{{ url('backend/js/custom.js') }}"></script>




</body>

</html>
