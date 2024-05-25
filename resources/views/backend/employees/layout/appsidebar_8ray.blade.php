<div class="sticky">
    <div class="app-sidebar__overlay" data-bs-toggle="sidebar"></div>
    <div class="app-sidebar">
        <div class="side-header">
            <a class="header-brand1" href="index.html">
                <img src="{{ url('backend/images/brand/logo-white.png') }}" class="header-brand-img desktop-logo" alt="logo">
                <img src="{{ url('backend/images/brand/icon-white.png') }}" class="header-brand-img toggle-logo" alt="logo">
                <img src="{{ url('backend/images/brand/icon-dark.png') }}" class="header-brand-img light-logo" alt="logo">
                <img src="{{ url('backend/images/brand/logo-darks.png') }}" class="header-brand-img light-logo1" alt="logo">
            </a>
            <!-- LOGO -->
        </div>
        <div class="main-sidemenu">
            <div class="slide-left disabled" id="slide-left">
                <svg xmlns="http://www.w3.org/2000/svg" fill="#7b8191" width="24" height="24" viewBox="0 0 24 24">
                    <path d="M13.293 6.293 7.586 12l5.707 5.707 1.414-1.414L10.414 12l4.293-4.293z"/>
                </svg>
            </div>
            <ul class="side-menu">
                <li class="sub-category">
                    <h3>Main</h3>
                </li>

                    <li class="slide">
                        <a class="side-menu__item has-link" data-bs-toggle="slide" href="index.html">
                            <i class="side-menu__icon fe fe-home"></i>
                            <span class="side-menu__label">8Ray Dashboard</span>
                        </a>
                    </li>

                    <li class="sub-category">
                        <h3>Product Management</h3>
                    </li>
                    <li class="slide">
                        <a class="side-menu__item" data-bs-toggle="slide" href="javascript:void(0)">
                            <i class="side-menu__icon fe fe-slack"></i>
                            <span class="side-menu__label">Product Management</span>
                            <i class="angle fe fe-chevron-right"></i>
                        </a>
                        <ul class="slide-menu">
                            <li class="side-menu-label1"><a href="javascript:void(0)">Product</a></li>
                            <li><a href="cards.html" class="slide-item"> All Product</a></li>
                            <li><a href="calendar.html" class="slide-item"> Add Product</a></li>
                        </ul>
                    </li>

                    <li class="slide">
                        <a class="side-menu__item" data-bs-toggle="slide" href="javascript:void(0)"><i class="side-menu__icon fe fe-slack"></i><span class="side-menu__label">Categories Management</span><i class="angle fe fe-chevron-right"></i></a>
                        <ul class="slide-menu">
                            <li class="side-menu-label1"><a href="javascript:void(0)">Categories Management</a></li>
                            <li><a href="cards.html" class="slide-item"> All Categories</a></li>
                            <li><a href="calendar.html" class="slide-item"> Add Categories</a></li>
                        </ul>
                    </li>

                    <li class="slide">
                        <a class="side-menu__item" data-bs-toggle="slide" href="javascript:void(0)"><i class="side-menu__icon fe fe-slack"></i><span class="side-menu__label">Brand Management</span><i class="angle fe fe-chevron-right"></i></a>
                        <ul class="slide-menu">
                            <li class="side-menu-label1"><a href="javascript:void(0)">Brand Management</a></li>
                            <li><a href="cards.html" class="slide-item"> All Brand</a></li>
                            <li><a href="calendar.html" class="slide-item"> Add Brand</a></li>
                        </ul>
                    </li>

                    <li class="sub-category">
                        <h3>Order Management</h3>
                    </li>

                    <li class="slide">
                        <a class="side-menu__item" data-bs-toggle="slide" href="javascript:void(0)"><i class="side-menu__icon fe fe-slack"></i><span class="side-menu__label">Order Management</span><i class="angle fe fe-chevron-right"></i></a>
                        <ul class="slide-menu">
                            <li class="side-menu-label1"><a href="javascript:void(0)">Order Management</a></li>
                            <li><a href="cards.html" class="slide-item"> All Order</a></li>
                            <li><a href="cards.html" class="slide-item"> Pending Order</a></li>
                            <li><a href="cards.html" class="slide-item"> Complete Order</a></li>

                        </ul>
                    </li>

                <li class="sub-category">
                    <h3>Post</h3>
                </li>
                <li class="slide">
                    <a class="side-menu__item" data-bs-toggle="slide" href="javascript:void(0)">
                        <i class="side-menu__icon fe fe fe-unlock"></i>
                        <span class="side-menu__label">Posts Management</span>
                        <i class="angle fe fe-chevron-right"></i>
                    </a>
                    <ul class="slide-menu">
                        <li class="side-menu-label1"><a href="javascript:void(0)">Posts Management</a></li>
                        <li><a href="{{ route('all.permission') }}" class="slide-item"> All Posts </a></li>
                        <li><a href="{{ route('all.roles') }}" class="slide-item">  Add Post </a></li>
                        <li><a href="{{ route('add.roles.permission') }}" class="slide-item"> Post Categoreies </a></li>
                        <li><a href="{{ route('add.roles.permission') }}" class="slide-item"> Post Tags </a></li>
                    </ul>
                </li>


                <li class="sub-category">
                    <h3>Role & Permission</h3>
                </li>
                <li class="slide">
                    <a class="side-menu__item" data-bs-toggle="slide" href="javascript:void(0)">
                        <i class="side-menu__icon fe fe fe-unlock"></i>
                        <span class="side-menu__label">Role & Permission</span>
                        <i class="angle fe fe-chevron-right"></i>
                    </a>
                    <ul class="slide-menu">
                        <li class="side-menu-label1"><a href="javascript:void(0)">Role & Permission</a></li>
                        <li><a href="{{ route('all.permission') }}" class="slide-item"> All Permission </a></li>
                        <li><a href="{{ route('all.roles') }}" class="slide-item">  All Role </a></li>
                        <li><a href="{{ route('add.roles.permission') }}" class="slide-item">  Roles in Permission </a></li>
                        <li><a href="{{ route('all.roles.permission') }}" class="slide-item">  All Roles in Permission </a></li>
                    </ul>
                </li>
            </ul>
            <div class="slide-right" id="slide-right"><svg xmlns="http://www.w3.org/2000/svg" fill="#7b8191" width="24" height="24" viewBox="0 0 24 24"><path d="M10.707 17.707 16.414 12l-5.707-5.707-1.414 1.414L13.586 12l-4.293 4.293z"/></svg></div>
        </div>
    </div>
    <!--/APP-SIDEBAR-->
</div>
