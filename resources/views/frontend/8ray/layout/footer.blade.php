<footer class="main">



    <section class="section-padding footer-mid">
        <div class="container pt-15 pb-20">
            <div class="row">
                <div class="col">
                    <div class="widget-about font-md mb-md-3 mb-lg-3 mb-xl-0 wow animate__animated animate__fadeInUp" data-wow-delay="0">
                        <div class="logo mb-30">
                            <a href="{{ route('8ray.frontend') }}" class="mb-15"><img src="{{ url('frontend/8ray/imgs/theme/logo-darks.png') }}" alt="logo" /></a>
                            <p class="font-lg text-heading">We sell not only goods but also customers' satisfaction and smile</p>
                        </div>
                        <ul class="contact-infor">
                            <li>
                                <img src="{{ url('frontend/8ray/imgs/theme/icons/icon-location.svg') }}" alt="" />
                                <strong>Address: </strong> <span>No.49, Moesandar Street, Hledan, Kamayut Township, Yangon.</span>
                            </li>
                            <li>
                                <img src="{{ url('frontend/8ray/imgs/theme/icons/icon-contact.svg') }}" alt="" />
                                <strong>Call Us:</strong><span>09450127303</span>
                            </li>
                            <li><img src="{{ url('frontend/8ray/imgs/theme/icons/icon-email-2.svg') }}" alt="" />
                                <strong>Email:</strong><span>8rayshop@gmail.com</span>
                            </li>
                            <li><img src="{{ url('frontend/8ray/imgs/theme/icons/icon-clock.svg') }}" alt="" />
                                <strong>Hours:</strong><span>10:00AM - 06:00PM, Daily Open</span>
                            </li>
                        </ul>
                    </div>
                </div>
                <div class=" text-center footer-link-widget col wow animate__animated animate__fadeInUp" data-wow-delay=".1s">
                    <h4 class=" widget-title">Company</h4>
                    <ul class="footer-list mb-sm-5 mb-md-0">
                        <li><a href="{{ route('8ray.aboutus') }}">About Us</a></li>
                        <li><a href="#">Delivery Information</a></li>
                        <li><a href="#">Privacy Policy</a></li>
                        <li><a href="#">Terms &amp; Conditions</a></li>
                        <li><a href="{{ route('8ray.contactus') }}">Contact Us</a></li>
                    </ul>
                </div>

                @php
                    $categories = App\Models\ProductCategory::orderBy('product_category_name', 'ASC')->get();
                @endphp

                <div class="text-center footer-link-widget col wow animate__animated animate__fadeInUp" data-wow-delay=".4s">
                    <h4 class="widget-title">Popular</h4>
                    <ul class="footer-list mb-sm-5 mb-md-0">
                        @foreach($categories as $category)
                            @if($category->id == 2)
                            <li>
                                <a href="{{ url('product/category/'.$category->id.'/'.$category->product_category_slug) }}">
                                    {{ $category->product_category_name }}
                                </a>
                            </li>
                            @endif
                        @endforeach
                        @foreach($categories as $category)
                            @if($category->id == 3)
                            <li>
                                <a href="{{ url('product/category/'.$category->id.'/'.$category->product_category_slug) }}">
                                    {{ $category->product_category_name }}
                                </a>
                            </li>
                            @endif
                        @endforeach
                        @foreach($categories as $category)
                            @if($category->id == 4)
                            <li>
                                <a href="{{ url('product/category/'.$category->id.'/'.$category->product_category_slug) }}">
                                    {{ $category->product_category_name }}
                                </a>
                            </li>
                            @endif
                        @endforeach
                        @foreach($categories as $category)
                            @if($category->id == 5)
                            <li>
                                <a href="{{ url('product/category/'.$category->id.'/'.$category->product_category_slug) }}">
                                    {{ $category->product_category_name }}
                                </a>
                            </li>
                            @endif
                        @endforeach

                        @foreach($categories as $category)
                            @if($category->id == 6)
                            <li>
                                <a href="{{ url('product/category/'.$category->id.'/'.$category->product_category_slug) }}">
                                    {{ $category->product_category_name }}
                                </a>
                            </li>
                            @endif
                        @endforeach

                        @foreach($categories as $category)
                            @if($category->id == 7)
                            <li>
                                <a href="{{ url('product/category/'.$category->id.'/'.$category->product_category_slug) }}">
                                    {{ $category->product_category_name }}
                                </a>
                            </li>
                            @endif
                        @endforeach

                        @foreach($categories as $category)
                            @if($category->id == 8)
                            <li>
                                <a href="{{ url('product/category/'.$category->id.'/'.$category->product_category_slug) }}">
                                    {{ $category->product_category_name }}
                                </a>
                            </li>
                            @endif
                        @endforeach

                        @foreach($categories as $category)
                            @if($category->id == 9)
                            <li>
                                <a href="{{ url('product/category/'.$category->id.'/'.$category->product_category_slug) }}">
                                    {{ $category->product_category_name }}
                                </a>
                            </li>
                            @endif
                        @endforeach

                        @foreach($categories as $category)
                            @if($category->id == 10)
                            <li>
                                <a href="{{ url('product/category/'.$category->id.'/'.$category->product_category_slug) }}">
                                    {{ $category->product_category_name }}
                                </a>
                            </li>
                            @endif
                        @endforeach

                        @foreach($categories as $category)
                            @if($category->id == 11)
                            <li>
                                <a href="{{ url('product/category/'.$category->id.'/'.$category->product_category_slug) }}">
                                    {{ $category->product_category_name }}
                                </a>
                            </li>
                            @endif
                        @endforeach
                    </ul>
                </div>

                <div class="text-center footer-link-widget col wow animate__animated animate__fadeInUp" data-wow-delay=".2s">
                    <h4 class="widget-title">Account</h4>
                    <ul class="footer-list mb-sm-5 mb-md-0">
                        <li><a href="{{ route('8ray.login') }}">Sign In</a></li>
                        <li><a href="{{ route('mycart') }}">View Cart</a></li>
                        <li><a href="{{ route('wishlist') }}">My Wishlist</a></li>
                        <li><a href="{{ route('compare') }}">Compare products</a></li>
                    </ul>
                </div>


            </div>
    </section>

</footer>
