<div class="mobile-header-active mobile-header-wrapper-style">
    <div class="mobile-header-wrapper-inner">
        <div class="mobile-header-top">
            <div class="mobile-header-logo">
                <a href="index.html"><img src="{{ url('frontend/8ray/imgs/theme/logo-darks.png') }}" alt="logo" /></a>
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
                <form action="#">
                    <input type="text" placeholder="Search for items…" />
                    <button type="submit"><i class="fi-rs-search"></i></button>
                </form>
            </div>
            <div class="mobile-menu-wrap mobile-header-border">
                <!-- mobile menu start -->
                <nav>
                    <ul class="mobile-menu font-heading">
                        <li class="menu-item-has-children">
                            <a href="index.html">Home</a>

                        </li>
                        <li class="menu-item-has-children">
                            <a href="shop-grid-right.html">Products</a>
                            @php
                                $categories = App\Models\ProductCategory::orderBy('product_category_name', 'ASC')->get();
                            @endphp
                            <ul class="dropdown">
                                @foreach($categories as $category)
                                    @if($category->id == 2)
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
                                            <li><a href="shop-filter.html">{{ $category->product_category_name }}</a></li>
                                        @endif
                                    @endif
                                @endforeach
                                @foreach($categories as $category)
                                    @if($category->id == 3)
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
                                            <li><a href="shop-filter.html">{{ $category->product_category_name }}</a></li>
                                        @endif
                                    @endif
                                @endforeach
                                @foreach($categories as $category)
                                    @if($category->id == 4)
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
                                            <li><a href="shop-filter.html">{{ $category->product_category_name }}</a></li>
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
                                            <li><a href="shop-filter.html">{{ $category->product_category_name }}</a></li>
                                        @endif
                                    @endif
                                @endforeach

                                @foreach($categories as $category)
                                    @if($category->id == 6)
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
                                            <li><a href="shop-filter.html">{{ $category->product_category_name }}</a></li>
                                        @endif
                                    @endif
                                @endforeach
                                @foreach($categories as $category)
                                    @if($category->id == 7)
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
                                            <li><a href="shop-filter.html">{{ $category->product_category_name }}</a></li>
                                        @endif
                                    @endif
                                @endforeach
                                @foreach($categories as $category)
                                    @if($category->id == 8)
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
                                            <li><a href="shop-filter.html">{{ $category->product_category_name }}</a></li>
                                        @endif
                                    @endif
                                @endforeach
                                @foreach($categories as $category)
                                    @if($category->id == 9)
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
                                            <li><a href="shop-filter.html">{{ $category->product_category_name }}</a></li>
                                        @endif
                                    @endif
                                @endforeach

                                @foreach($categories as $category)
                                    @if($category->id == 10)
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
                                            <li><a href="shop-filter.html">{{ $category->product_category_name }}</a></li>
                                        @endif
                                    @endif
                                @endforeach

                                @foreach($categories as $category)
                                    @if($category->id == 11)
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
                                            <li><a href="shop-filter.html">{{ $category->product_category_name }}</a></li>
                                        @endif
                                    @endif
                                @endforeach
                            </ul>
                        </li>
                        <li class="menu-item-has-children">
                            <a href="blog-category-fullwidth.html">Blog</a>
                            <ul class="dropdown">
                                <li><a href="blog-category-grid.html">Blog Category Grid</a></li>
                                <li><a href="blog-category-list.html">Blog Category List</a></li>
                                <li><a href="blog-category-big.html">Blog Category Big</a></li>
                                <li><a href="blog-category-fullwidth.html">Blog Category Wide</a></li>
                                <li class="menu-item-has-children">
                                    <a href="#">Single Product Layout</a>
                                    <ul class="dropdown">
                                        <li><a href="blog-post-left.html">Left Sidebar</a></li>
                                        <li><a href="blog-post-right.html">Right Sidebar</a></li>
                                        <li><a href="blog-post-fullwidth.html">No Sidebar</a></li>
                                    </ul>
                                </li>
                            </ul>
                        </li>
                        <li class="menu-item-has-children">
                            <a href="index.html">About Us</a>
                        </li>
                        <li class="menu-item-has-children">
                            <a href="index.html">About Us</a>
                        </li>
                    </ul>
                </nav>
                <!-- mobile menu end -->
            </div>
            <div class="mobile-header-info-wrap">
                <div class="single-mobile-header-info">
                    <a href="page-contact.html"><i class="fi-rs-marker"></i> Our location </a>
                </div>
                <div class="single-mobile-header-info">
                    <a href="page-login.html"><i class="fi-rs-user"></i>Log In / Sign Up </a>
                </div>
                <div class="single-mobile-header-info">
                    <a href="#"><i class="fi-rs-headphones"></i>09 450127303 </a>
                </div>
            </div>
        </div>
    </div>
</div>
