<header class="header-area header-style-1 header-height-2">

    <!-- header-info-->
    <div class="header-top header-top-ptb-1 d-none d-lg-block">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-xl-3 col-lg-4">
                    <div class="header-info">
                        <ul>
                            <li><a href="{{ route('mycart') }}">My Cart</a></li>
                            <li><a href="{{ route('checkout') }}">Checkout</a></li>
                        </ul>
                    </div>
                </div>
                <div class="col-xl-6 col-lg-4">
                    <div class="text-center">
                        <div id="news-flash" class="d-inline-block">
                            <ul>

                            </ul>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-lg-4">
                    <div class="header-info header-info-right">
                        <ul>
                             <li> Call Us: <strong class="text-brand"> 09 450 127 303, 09 450 127 304</strong></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Search Box-->
    <div class="header-middle header-middle-ptb-1 d-none d-lg-block">
        <div class="container">
            <div class="header-wrap">
                <div class="logo logo-width-1">
                    <a href="{{ route('8ray.frontend') }}">
                        <img src="{{ url('frontend/8ray/imgs/theme/logo-darks.png') }}" alt="logo" /></a>
                </div>
                <div class="header-right">
                    <div class="search-style-2">
                        <form action="{{ route('products.search') }}" method="post">
                            @csrf
                            <select class="select-active">
                                <option>All Categories</option>
                            </select>
                            <input onfocus="search_result_show()" onblur="search_result_hide()" name="search" id="search" placeholder="Search for items..." />
                            <div id="searchProducts"></div>
                        </form>
                    </div>
                    <div class="header-action-right">
                        <div class="header-action-2">

                            <div class="header-action-icon-2">
                                <a href="{{ route('compare') }}">
                                    <img class="svgInject" alt="Nest" src="{{ asset('frontend/8ray/imgs/theme/icons/icon-compare.svg')}}" />
                                </a>
                                <a href="{{ route('compare') }}"><span class="lable ml-0">Compare</span></a>
                            </div>

                            <div class="header-action-icon-2">
                                <a href="{{ route('wishlist') }}">
                                    <img class="svgInject" alt="Nest" src="{{ url('frontend/8ray/imgs/theme/icons/icon-heart.svg') }}" />
                                    <span class="pro-count blue" id="wishQty">0 </span>
                                </a>
                                <a href="{{ route('wishlist') }}"><span class="lable">Wishlist</span></a>
                            </div>
                            <div class="header-action-icon-2">

                                <a class="mini-cart-icon" href="{{ route('mycart') }}">
                                    <img alt="Nest" src="{{ url('frontend/8ray/imgs/theme/icons/icon-cart.svg') }}" />
                                    <span class="pro-count blue" id="cartQty">0</span>
                                </a>

                                <a href="{{ route('mycart') }}"><span class="lable">Cart</span></a>
                                <div class="cart-dropdown-wrap cart-dropdown-hm2">
                                    <!--   // mini cart start with ajax -->
                                    <div id="miniCart">

                                    </div>
                                    <!--   // End mini cart start with ajax -->
                                    <div class="shopping-cart-footer">
                                        <div class="shopping-cart-total">
                                            <h4>Total <span id="cartSubTotal"> </span> </h4>
                                        </div>
                                        <div class="shopping-cart-button">
                                            <a href="{{ route('mycart') }}" class="outline">View cart</a>
                                            <a href="{{ route('checkout') }}">Checkout</a>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            @auth
                                <div class="header-action-icon-2">
                                    <a href="{{ route('8ray.user.profile.edit') }}">
                                        <img class="svgInject" alt="Nest" src="{{ url('frontend/8ray/imgs/theme/icons/icon-user.svg') }}" />
                                    </a>

                                    <a href="{{ route('8ray.user.profile.edit') }}"><span class="lable ml-0">Account</span></a>
                                    <div class="cart-dropdown-wrap cart-dropdown-hm2 account-dropdown">
                                        <ul>
                                            <li>
                                                <a href="{{ route('8ray.user.profile.edit') }}"><i class="fi fi-rs-user mr-10"></i> {{ Auth::user()->name }}</a>
                                            </li>
                                            <li>
                                                <a href="{{ route('8ray.user.order') }}"><i class="fi fi-rs-location-alt mr-10"></i>Order</a>
                                            </li>
                                            <li>
                                                <a href="{{ route('8ray.user.track.order') }}"><i class="fi fi-rs-location-alt mr-10"></i>Order Tracking</a>
                                            </li>
                                            <li>
                                                <a href="#"><i class="fi fi-rs-heart mr-10"></i>My Wishlist</a>
                                            </li>
                                            <li>
                                                <a href="{{ route('8ray.logout') }}"><i class="fi fi-rs-sign-out mr-10"></i>Sign out</a>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            @else
                                <div class="header-action-icon-2">
                                    <a href="page-account.html">
                                        <img class="svgInject" alt="Nest" src="{{ url('frontend/8ray/imgs/theme/icons/icon-user.svg') }}" />
                                    </a>
                                    <a href="{{ route('8ray.login') }}"><span class="lable ml-0">Login</span></a>
                                </div>
                            @endauth
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--End Search Box-->

    <div class="header-bottom header-bottom-bg-color sticky-bar">
        <div class="container">
            <div class="header-wrap header-space-between position-relative">
                <div class="logo logo-width-1 d-block d-lg-none">
                    <a href="{{ route('8ray.frontend') }}">
                        <img src="{{ url('frontend/8ray/imgs/theme/logo-darks.png') }}" id="logo" alt="logo" />
                    </a>
                </div>

                <!-- For Big Screen -->
                <div class="header-nav d-none d-lg-flex">
                    <div class="main-menu main-menu-padding-1 main-menu-lh-2 d-none d-lg-block font-heading">
                        <nav>
                            <ul>
                                <!-- Home -->
                                <li><a class="active" href="{{ route('8ray.frontend') }}">Home  </a></li>

                                <!-- Products -->
                                <li>
                                    <a href="{{ route('8ray.allproduct') }}">Products <i class="fi-rs-angle-down"></i></a>
                                    <ul class="sub-menu">
                                        @php
                                            $categories = App\Models\ProductCategory::orderBy('product_category_name', 'ASC')->get();
                                        @endphp

                                        <!-- Lighting and Accessories -->
                                        @foreach($categories as $category)
                                            @if($category->id == 2)
                                                @if($category->productSubCategories->count() > 0)
                                                    <li>
                                                        <a href="{{ url('product/category/'.$category->id.'/'.$category->product_category_slug) }}">{{ $category->product_category_name }} <i class="fi-rs-angle-right"></i></a>
                                                        <ul class="level-menu">
                                                            @foreach($category->productSubCategories as $subcategory)
                                                                <li><a href="{{ url('product/subcategory/'.$subcategory->id.'/'.$subcategory->product_subcategory_slug) }}">{{ $subcategory->product_subcategory_name }}</a></li>
                                                            @endforeach
                                                        </ul>
                                                    </li>
                                                @else
                                                    <li><a href="{{ url('product/category/'.$category->id.'/'.$category->product_category_slug) }}">{{ $category->product_category_name }}</a></li>
                                                @endif
                                            @endif
                                        @endforeach

                                        <!-- Microphones -->
                                        @foreach($categories as $category)
                                            @if($category->id == 3)
                                                @if($category->productSubCategories->count() > 0)
                                                    <li>
                                                        <a href="{{ url('product/category/'.$category->id.'/'.$category->product_category_slug) }}">{{ $category->product_category_name }} <i class="fi-rs-angle-right"></i></a>
                                                        <ul class="level-menu">
                                                            @foreach($category->productSubCategories as $subcategory)
                                                                <li><a href="{{ url('product/subcategory/'.$subcategory->id.'/'.$subcategory->product_subcategory_slug) }}">{{ $subcategory->product_subcategory_name }}</a></li>
                                                            @endforeach
                                                        </ul>
                                                    </li>
                                                @else
                                                    <li><a href="{{ url('product/category/'.$category->id.'/'.$category->product_category_slug) }}">{{ $category->product_category_name }}</a></li>
                                                @endif
                                            @endif
                                        @endforeach

                                        <!-- Microphone stand and desk setup stan -->
                                        @foreach($categories as $category)
                                            @if($category->id == 4)
                                                @if($category->productSubCategories->count() > 0)
                                                    <li>
                                                        <a href="{{ url('product/category/'.$category->id.'/'.$category->product_category_slug) }}">{{ $category->product_category_name }} <i class="fi-rs-angle-right"></i></a>
                                                        <ul class="level-menu">
                                                            @foreach($category->productSubCategories as $subcategory)
                                                                <li><a href="{{ url('product/subcategory/'.$subcategory->id.'/'.$subcategory->product_subcategory_slug) }}">{{ $subcategory->product_subcategory_name }}</a></li>
                                                            @endforeach
                                                        </ul>
                                                    </li>
                                                @else
                                                    <li><a href="{{ url('product/category/'.$category->id.'/'.$category->product_category_slug) }}">{{ $category->product_category_name }}</a></li>
                                                @endif
                                            @endif
                                        @endforeach

                                        <!-- Tripods & Selfie Sticks -->
                                        @foreach($categories as $category)
                                            @if($category->id == 5)
                                                @if($category->productSubCategories->count() > 0)
                                                    <li>
                                                        <a href="{{ url('product/category/'.$category->id.'/'.$category->product_category_slug) }}">{{ $category->product_category_name }} <i class="fi-rs-angle-right"></i></a>
                                                        <ul class="level-menu">
                                                            @foreach($category->productSubCategories as $subcategory)
                                                                <li><a href="{{ url('product/subcategory/'.$subcategory->id.'/'.$subcategory->product_subcategory_slug) }}">{{ $subcategory->product_subcategory_name }}</a></li>
                                                            @endforeach
                                                        </ul>
                                                    </li>
                                                @else
                                                    <li><a href="{{ url('product/category/'.$category->id.'/'.$category->product_category_slug) }}l">{{ $category->product_category_name }}</a></li>
                                                @endif
                                            @endif
                                        @endforeach

                                        <!-- Stabilizers -->
                                        @foreach($categories as $category)
                                            @if($category->id == 6)
                                                @if($category->productSubCategories->count() > 0)
                                                    <li>
                                                        <a href="{{ url('product/category/'.$category->id.'/'.$category->product_category_slug) }}">{{ $category->product_category_name }} <i class="fi-rs-angle-right"></i></a>
                                                        <ul class="level-menu">
                                                            @foreach($category->productSubCategories as $subcategory)
                                                                <li><a href="{{ url('product/subcategory/'.$subcategory->id.'/'.$subcategory->product_subcategory_slug) }}">{{ $subcategory->product_subcategory_name }}</a></li>
                                                            @endforeach
                                                        </ul>
                                                    </li>
                                                @else
                                                    <li><a href="{{ url('product/category/'.$category->id.'/'.$category->product_category_slug) }}">{{ $category->product_category_name }}</a></li>
                                                @endif
                                            @endif
                                        @endforeach

                                        <!-- Product Photography Accessories -->
                                        @foreach($categories as $category)
                                            @if($category->id == 7)
                                                @if($category->productSubCategories->count() > 0)
                                                    <li>
                                                        <a href="{{ url('product/category/'.$category->id.'/'.$category->product_category_slug) }}">{{ $category->product_category_name }} <i class="fi-rs-angle-right"></i></a>
                                                        <ul class="level-menu">
                                                            @foreach($category->productSubCategories as $subcategory)
                                                                <li><a href="{{ url('product/subcategory/'.$subcategory->id.'/'.$subcategory->product_subcategory_slug) }}">{{ $subcategory->product_subcategory_name }}</a></li>
                                                            @endforeach
                                                        </ul>
                                                    </li>
                                                @else
                                                    <li><a href="{{ url('product/category/'.$category->id.'/'.$category->product_category_slug) }}">{{ $category->product_category_name }}</a></li>
                                                @endif
                                            @endif
                                        @endforeach

                                        <!-- Gopro & Accessories  -->
                                        @foreach($categories as $category)
                                            @if($category->id == 8)
                                                @if($category->productSubCategories->count() > 0)
                                                    <li>
                                                        <a href="{{ url('product/category/'.$category->id.'/'.$category->product_category_slug) }}">{{ $category->product_category_name }} <i class="fi-rs-angle-right"></i></a>
                                                        <ul class="level-menu">
                                                            @foreach($category->productSubCategories as $subcategory)
                                                                <li><a href="{{ url('product/subcategory/'.$subcategory->id.'/'.$subcategory->product_subcategory_slug) }}">{{ $subcategory->product_subcategory_name }}</a></li>
                                                            @endforeach
                                                        </ul>
                                                    </li>
                                                @else
                                                    <li><a href="{{ url('product/category/'.$category->id.'/'.$category->product_category_slug) }}">{{ $category->product_category_name }}</a></li>
                                                @endif
                                            @endif
                                        @endforeach

                                        <!-- It Gadget -->
                                        @foreach($categories as $category)
                                            @if($category->id == 10)
                                                @if($category->productSubCategories->count() > 0)
                                                    <li>
                                                        <a href="{{ url('product/category/'.$category->id.'/'.$category->product_category_slug) }}">{{ $category->product_category_name }} <i class="fi-rs-angle-right"></i></a>
                                                        <ul class="level-menu">
                                                            @foreach($category->productSubCategories as $subcategory)
                                                                <li><a href="{{ url('product/subcategory/'.$subcategory->id.'/'.$subcategory->product_subcategory_slug) }}">{{ $subcategory->product_subcategory_name }}</a></li>
                                                            @endforeach
                                                        </ul>
                                                    </li>
                                                @else
                                                    <li><a href="{{ url('product/category/'.$category->id.'/'.$category->product_category_slug) }}">{{ $category->product_category_name }}</a></li>
                                                @endif
                                            @endif
                                        @endforeach

                                        <!-- Sound Products -->
                                        @foreach($categories as $category)
                                            @if($category->id == 9)
                                                @if($category->productSubCategories->count() > 0)
                                                    <li>
                                                        <a href="{{ url('product/category/'.$category->id.'/'.$category->product_category_slug) }}">{{ $category->product_category_name }} <i class="fi-rs-angle-right"></i></a>
                                                        <ul class="level-menu">
                                                            @foreach($category->productSubCategories as $subcategory)
                                                                <li><a href="{{ url('product/subcategory/'.$subcategory->id.'/'.$subcategory->product_subcategory_slug) }}">{{ $subcategory->product_subcategory_name }}</a></li>
                                                            @endforeach
                                                        </ul>
                                                    </li>
                                                @else
                                                    <li><a href="{{ url('product/category/'.$category->id.'/'.$category->product_category_slug) }}">{{ $category->product_category_name }}</a></li>
                                                @endif
                                            @endif
                                        @endforeach

                                        <!-- CCTV -->
                                        @foreach($categories as $category)
                                            @if($category->id == 11)
                                                @if($category->productSubCategories->count() > 0)
                                                    <li>
                                                        <a href="{{ url('product/category/'.$category->id.'/'.$category->product_category_slug) }}">{{ $category->product_category_name }} <i class="fi-rs-angle-right"></i></a>
                                                        <ul class="level-menu">
                                                            @foreach($category->productSubCategories as $subcategory)
                                                                <li><a href="{{ url('product/subcategory/'.$subcategory->id.'/'.$subcategory->product_subcategory_slug) }}">{{ $subcategory->product_subcategory_name }}</a></li>
                                                            @endforeach
                                                        </ul>
                                                    </li>
                                                @else
                                                    <li><a href="{{ url('product/category/'.$category->id.'/'.$category->product_category_slug) }}">{{ $category->product_category_name }}</a></li>
                                                @endif
                                            @endif
                                        @endforeach

                                    </ul>
                                </li>

                                <!-- Brands -->
                                <li><a href="{{ route('8ray.brandzone') }}">Brand Zone</a></li>

                                <!-- Blogs
                                <li>
                                    <a href="blog-category-grid.html">Blog <i class="fi-rs-angle-down"></i></a>
                                    <ul class="sub-menu">
                                        <li><a href="blog-category-grid.html">Blog Category Grid</a></li>
                                        <li><a href="blog-category-list.html">Blog Category List</a></li>
                                        <li><a href="blog-category-big.html">Blog Category Big</a></li>
                                        <li><a href="blog-category-fullwidth.html">Blog Category Wide</a></li>
                                        <li>
                                            <a href="#">Single Post <i class="fi-rs-angle-right"></i></a>
                                            <ul class="level-menu level-menu-modify">
                                                <li><a href="blog-post-left.html">Left Sidebar</a></li>
                                                <li><a href="blog-post-right.html">Right Sidebar</a></li>
                                                <li><a href="blog-post-fullwidth.html">No Sidebar</a></li>
                                            </ul>
                                        </li>
                                    </ul>
                                </li>
                                -->

                                <li><a href="{{ route('8ray.aboutus') }}">About</a></li>

                                <li><a href="{{ route('8ray.contactus') }}">Contact</a></li>
                            </ul>
                        </nav>
                    </div>
                </div>
                <div class="hotline d-none d-lg-flex">
                    <img src="{{ url('frontend/8ray/imgs/theme/icons/icon-headphone.svg') }}" alt="hotline" />
                    <p>09 450 127 303<span>Open Daily - 10:00AM to 06:00PM</span></p>
                </div>
                <!-- End For Big Screen -->

                <!-- For Mobile Screen -->
                <div class="header-action-icon-2 d-block d-lg-none">
                    <div class="burger-icon burger-icon-white">
                        <span class="burger-icon-top"></span>
                        <span class="burger-icon-mid"></span>
                        <span class="burger-icon-bottom"></span>
                    </div>
                </div>
                <div class="header-action-right d-block d-lg-none">
                    <div class="header-action-2">
                        <!-- Wishlist Icon for Mobile View -->
                        <div class="header-action-icon-2">
                            <a href="{{ route('wishlist') }}">
                                <img alt="Nest" src="{{ url('frontend/8ray/imgs/theme/icons/icon-heart.svg') }}" />
                                <span class="pro-count white" id="wishQtyMobile">0 </span>
                            </a>
                        </div>

                        <!-- Cart Icon for Mobile View -->
                        <div class="header-action-icon-2">
                            <a class="mini-cart-icon" href="#">
                                <img alt="Nest" src="{{ url('frontend/8ray/imgs/theme/icons/icon-cart.svg') }}" />
                                <span class="pro-count blue" id="cartQtyMobile">0</span>
                            </a>
                            <div class="cart-dropdown-wrap cart-dropdown-hm2">
                                <!-- Mini Cart Start for Mobile View -->
                                <div id="miniCartMobile"></div>
                                <!-- End Mini Cart Start for Mobile View -->
                                <div class="shopping-cart-footer">
                                    <div class="shopping-cart-total">
                                        <h4>Total <span id="cartSubTotalMobile"></span></h4>
                                    </div>
                                    <div class="shopping-cart-button">
                                        <a href="{{ route('mycart') }}" class="outline">View cart</a>
                                        <a href="{{ route('checkout') }}">Checkout</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>


            </div>
        </div>
    </div>
</header>
