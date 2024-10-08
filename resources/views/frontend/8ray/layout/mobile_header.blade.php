<div class="mobile-header-active mobile-header-wrapper-style">
    <div class="mobile-header-wrapper-inner">
        <div class="mobile-header-top">
            <div class="mobile-header-logo">
                <a href="{{ route('8ray.frontend') }}"><img src="{{ url('frontend/8ray/imgs/theme/logo-darks.png') }}"  alt="logo" /></a>
            </div>
            <div class="mobile-menu-close close-style-wrap close-style-position-inherit">
                <button class="close-style search-close">
                    <i class="icon-top"></i>
                    <i class="icon-bottom"></i>
                </button>
            </div>
        </div>
        <div class="mobile-header-content-area">
            <div class="mobile-search search-style-3 mobile-header-border">
                <form action="{{ route('products.search') }}" method="post">
                    @csrf
                    <input name="search" id="search" placeholder="Search for items..." />
                    <button type="submit"><i class="fi-rs-search"></i></button>
                </form>
            </div>
            <div class="mobile-menu-wrap mobile-header-border">
                <!-- mobile menu start -->
                <nav>
                    <ul class="mobile-menu font-heading">
                        <li class="menu-item-has-children">
                            <a href="{{ route('8ray.frontend') }}">Home</a>

                        </li>
                        <li class="menu-item-has-children">
                            <a href="#">Products</a>
                            @php
                                $categories = App\Models\ProductCategory::orderBy('product_category_name', 'ASC')->get();
                            @endphp
                            <ul class="dropdown">

                                <li class="menu-item-has-children">
                                    <a href="{{ route('8ray.allproduct') }}">All Products</a>
                                </li>

                                @foreach($categories as $category)
                                    @if($category->id == 2)
                                        @if($category->productSubCategories->count() > 0)
                                            <li class="menu-item-has-children">
                                                <a href="{{ url('product/category/'.$category->id.'/'.$category->product_category_slug) }}">{{ $category->product_category_name }}</a>
                                                 <ul class="dropdown">
                                                    @foreach($category->productSubCategories as $subcategory)
                                                         <li><a href="vendors-grid.html">{{ $subcategory->product_subcategory_name }}</a></li>
                                                    @endforeach
                                                </ul>
                                            </li>
                                        @else
                                            <li><a href="{{ url('product/category/'.$category->id.'/'.$category->product_category_slug) }}">{{ $category->product_category_name }}</a></li>
                                        @endif
                                    @endif
                                @endforeach

                                @foreach($categories as $category)
                                    @if($category->id == 3)
                                        @if($category->productSubCategories->count() > 0)
                                            <li class="menu-item-has-children">
                                                <a href="{{ url('product/category/'.$category->id.'/'.$category->product_category_slug) }}">{{ $category->product_category_name }}</a>
                                                 <ul class="dropdown">
                                                    @foreach($category->productSubCategories as $subcategory)
                                                         <li><a href="vendors-grid.html">{{ $subcategory->product_subcategory_name }}</a></li>
                                                    @endforeach
                                                </ul>
                                            </li>
                                        @else
                                            <li><a href="{{ url('product/category/'.$category->id.'/'.$category->product_category_slug) }}">{{ $category->product_category_name }}</a></li>
                                        @endif
                                    @endif
                                @endforeach

                                @foreach($categories as $category)
                                    @if($category->id == 4)
                                        @if($category->productSubCategories->count() > 0)
                                            <li class="menu-item-has-children">
                                                <a href="{{ url('product/category/'.$category->id.'/'.$category->product_category_slug) }}">{{ $category->product_category_name }}</a>
                                                 <ul class="dropdown">
                                                    @foreach($category->productSubCategories as $subcategory)
                                                         <li><a href="vendors-grid.html">{{ $subcategory->product_subcategory_name }}</a></li>
                                                    @endforeach
                                                </ul>
                                            </li>
                                        @else
                                            <li><a href="{{ url('product/category/'.$category->id.'/'.$category->product_category_slug) }}">{{ $category->product_category_name }}</a></li>
                                        @endif
                                    @endif
                                @endforeach
                                @foreach($categories as $category)
                                    @if($category->id == 5)
                                        @if($category->productSubCategories->count() > 0)
                                            <li class="menu-item-has-children">
                                                <a href="#">{{ $category->product_category_name }}</a>
                                                 <ul class="dropdown">
                                                    @foreach($category->productSubCategories as $subcategory)
                                                         <li><a href="vendors-grid.html">{{ $subcategory->product_subcategory_name }}</a></li>
                                                    @endforeach
                                                </ul>
                                            </li>
                                        @else
                                            <li><a href="{{ url('product/category/'.$category->id.'/'.$category->product_category_slug) }}">{{ $category->product_category_name }}</a></li>
                                        @endif
                                    @endif
                                @endforeach

                                @foreach($categories as $category)
                                    @if($category->id == 6)
                                        @if($category->productSubCategories->count() > 0)
                                            <li class="menu-item-has-children">
                                                <a href="{{ url('product/category/'.$category->id.'/'.$category->product_category_slug) }}">{{ $category->product_category_name }}</a>
                                                 <ul class="dropdown">
                                                    @foreach($category->productSubCategories as $subcategory)
                                                         <li><a href="vendors-grid.html">{{ $subcategory->product_subcategory_name }}</a></li>
                                                    @endforeach
                                                </ul>
                                            </li>
                                        @else
                                            <li><a href="{{ url('product/category/'.$category->id.'/'.$category->product_category_slug) }}">{{ $category->product_category_name }}</a></li>
                                        @endif
                                    @endif
                                @endforeach
                                @foreach($categories as $category)
                                    @if($category->id == 7)
                                        @if($category->productSubCategories->count() > 0)
                                            <li class="menu-item-has-children">
                                                <a href="{{ url('product/category/'.$category->id.'/'.$category->product_category_slug) }}">{{ $category->product_category_name }}</a>
                                                 <ul class="dropdown">
                                                    @foreach($category->productSubCategories as $subcategory)
                                                         <li><a href="vendors-grid.html">{{ $subcategory->product_subcategory_name }}</a></li>
                                                    @endforeach
                                                </ul>
                                            </li>
                                        @else
                                            <li><a href="{{ url('product/category/'.$category->id.'/'.$category->product_category_slug) }}">{{ $category->product_category_name }}</a></li>
                                        @endif
                                    @endif
                                @endforeach
                                @foreach($categories as $category)
                                    @if($category->id == 8)
                                        @if($category->productSubCategories->count() > 0)
                                            <li class="menu-item-has-children">
                                                <a href="{{ url('product/category/'.$category->id.'/'.$category->product_category_slug) }}">{{ $category->product_category_name }}</a>
                                                 <ul class="dropdown">
                                                    @foreach($category->productSubCategories as $subcategory)
                                                         <li><a href="vendors-grid.html">{{ $subcategory->product_subcategory_name }}</a></li>
                                                    @endforeach
                                                </ul>
                                            </li>
                                        @else
                                            <li><a href="{{ url('product/category/'.$category->id.'/'.$category->product_category_slug) }}">{{ $category->product_category_name }}</a></li>
                                        @endif
                                    @endif
                                @endforeach
                                @foreach($categories as $category)
                                    @if($category->id == 9)
                                        @if($category->productSubCategories->count() > 0)
                                            <li class="menu-item-has-children">
                                                <a href="{{ url('product/category/'.$category->id.'/'.$category->product_category_slug) }}">{{ $category->product_category_name }}</a>
                                                 <ul class="dropdown">
                                                    @foreach($category->productSubCategories as $subcategory)
                                                         <li><a href="vendors-grid.html">{{ $subcategory->product_subcategory_name }}</a></li>
                                                    @endforeach
                                                </ul>
                                            </li>
                                        @else
                                            <li><a href="{{ url('product/category/'.$category->id.'/'.$category->product_category_slug) }}">{{ $category->product_category_name }}</a></li>
                                        @endif
                                    @endif
                                @endforeach

                                @foreach($categories as $category)
                                    @if($category->id == 10)
                                        @if($category->productSubCategories->count() > 0)
                                            <li class="menu-item-has-children">
                                                <a href="{{ url('product/category/'.$category->id.'/'.$category->product_category_slug) }}">{{ $category->product_category_name }}</a>
                                                 <ul class="dropdown">
                                                    @foreach($category->productSubCategories as $subcategory)
                                                         <li><a href="vendors-grid.html">{{ $subcategory->product_subcategory_name }}</a></li>
                                                    @endforeach
                                                </ul>
                                            </li>
                                        @else
                                            <li><a href="{{ url('product/category/'.$category->id.'/'.$category->product_category_slug) }}">{{ $category->product_category_name }}</a></li>
                                        @endif
                                    @endif
                                @endforeach

                                @foreach($categories as $category)
                                    @if($category->id == 11)
                                        @if($category->productSubCategories->count() > 0)
                                            <li class="menu-item-has-children">
                                                <a href="{{ url('product/category/'.$category->id.'/'.$category->product_category_slug) }}">{{ $category->product_category_name }}</a>
                                                 <ul class="dropdown">
                                                    @foreach($category->productSubCategories as $subcategory)
                                                         <li><a href="vendors-grid.html">{{ $subcategory->product_subcategory_name }}</a></li>
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
                        <li class="menu-item-has-children">
                            <a href="{{ route('8ray.aboutus') }}">About Us</a>
                        </li>
                        <li class="menu-item-has-children">
                            <a href="{{ route('8ray.contactus') }}">Contact Us</a>
                        </li>
                        @auth
                        <li class="menu-item-has-children">
                            <a href="#">Account</a>
                            <ul class="dropdown">
                                <li><a href="{{ route('8ray.user.profile.edit') }}">{{ Auth::user()->name }}</a></li>
                                <li><a href="{{ route('8ray.user.order') }}">Order</a></li>
                                <li><a href="{{ route('8ray.user.track.order') }}">Order Tracking</a></li>
                            </ul>
                        </li>
                        @endauth
                    </ul>
                </nav>
                <!-- mobile menu end -->
            </div>
            <div class="mobile-header-info-wrap">
                <div class="single-mobile-header-info">
                    <a class="btn btn-xs text-white" href="{{ route('8ray.contactus') }}"><i class="fi-rs-marker"></i> Our location </a>
                </div>

                <div class="single-mobile-header-info">
                    <a class="btn btn-xs text-white" href="{{ route('8ray.contactus') }}"><i class="fi-rs-headphones"></i>09 450127303 </a>
                </div>

                @auth
                <div class="single-mobile-header-info ">
                    <a class="btn btn-xs text-white" style="background-color: red" href="{{ route('8ray.logout') }}">
                        <i class="fi-rs-user text-white"></i>Log out
                    </a>
                </div>
                @else
                <div class="single-mobile-header-info">
                    <a class="btn btn-xs text-white" style="background-color: red" href="{{ route('8ray.login') }}">
                        <i class="fi-rs-user text-white"></i>Log in
                    </a>
                </div>
                @endauth
            </div>
        </div>
    </div>
</div>
