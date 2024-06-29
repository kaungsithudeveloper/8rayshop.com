@extends('frontend.8ray.layout.layout')

@section('8ray')

<main class="main">

    <!--Start banners-->
    <section class="banners mt-40 mb-25">
        <div class="container">
            <div class="row">
                <div class="col-lg-4 col-md-6">
                    <div class="banner-img wow animate__animated animate__fadeInUp" data-wow-delay="0">
                        <img src="{{ url('frontend/8ray/imgs/banner/banner-1.png') }}" alt="" />
                        <div class="banner-text">
                            <h4>
                                Microphones<br />Lighting and Accessories<br />
                                Tripods & Selfie Sticks
                            </h4>
                            <a href="shop-grid-right.html" class="btn btn-xs">Shop Now <i class="fi-rs-arrow-small-right"></i></a>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6">
                    <div class="banner-img wow animate__animated animate__fadeInUp" data-wow-delay=".2s">
                        <img src="{{ url('frontend/8ray/imgs/banner/banner-3.png') }}" alt="" />
                        <div class="banner-text">
                            <h4>
                               Gopro Camera & <br />
                                 Action Cam <br /> Accessories
                            </h4>
                            <a href="shop-grid-right.html" class="btn btn-xs">Shop Now <i class="fi-rs-arrow-small-right"></i></a>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 d-md-none d-lg-flex">
                    <div class="banner-img mb-sm-0 wow animate__animated animate__fadeInUp" data-wow-delay=".4s">
                        <img src="{{ url('frontend/8ray/imgs/banner/banner-2.png') }}" alt="" />
                        <div class="banner-text">
                            <h4>CCTV &<br />
                                security system <br />Accessories</h4>
                            <a href="shop-grid-right.html" class="btn btn-xs">Shop Now <i class="fi-rs-arrow-small-right"></i></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!--End banners-->



    <section class="product-tabs section-padding position-relative">
        <div class="container">
            <div class="section-title style-2 wow animate__animated animate__fadeIn">
                <h3> New Products </h3>

            </div>
            <!--End nav-tabs-->
            <div class="tab-content" id="myTabContent">
                <div class="row product-grid-4">
                    <!--end product card-->
                    @foreach ($newProducts as $product)
                        <div class="col-lg-2 col-md-3 col-6 col-sm-6">
                            <div class="product-cart-wrap mb-30 wow animate__animated animate__fadeIn card-container" data-wow-delay=".1s">
                                <div class="product-img-action-wrap">
                                    <div class="product-img product-img-zoom">
                                        <a href="shop-product-right.html">
                                            <img class="default-img" src="{{ !empty($product->product_photo) ? url('upload/product_images/' . $product->product_photo) : url('frontend/8ray/imgs/shop/product-1-2.jpg') }}" alt="" />

                                            @php
                                                $multiImage = $product->multiImages->first();
                                            @endphp
                                            <img class="hover-img" src="{{ !empty($multiImage) ? url('upload/product_multi_images/' . $multiImage->photo_name) : url('frontend/8ray/imgs/shop/product-1-2.jpg') }}" alt="" />
                                        </a>
                                    </div>
                                    <div class="product-action-1">
                                        <a aria-label="Quick view" class="action-btn small hover-up" data-bs-toggle="modal" data-bs-target="#quickViewModal"> <i class="fi-rs-eye"></i></a>
                                        <a aria-label="Add To Wishlist" class="action-btn small hover-up" href="shop-wishlist.html"><i class="fi-rs-heart"></i></a>
                                        <a aria-label="Compare" class="action-btn small hover-up" href="shop-compare.html"><i class="fi-rs-shuffle"></i></a>
                                    </div>
                                    <div class="product-badges product-badges-position product-badges-mrg">
                                        @if ($product->productInfo)
                                            @if ($product->productInfo->best_sale)
                                                <span class="best">Best Sale</span>
                                            @endif
                                        @endif
                                    </div>
                                </div>
                                <div class="product-content-wrap">
                                    <div class="product-category">
                                        @foreach ($product->brands as $category)
                                            <a href="shop-grid-right.html">{{ $category->brand_name }}</a>
                                        @endforeach
                                    </div>
                                    <h2><a href="shop-product-right.html">{{ $product->product_name }}</a></h2>
                                    <div class="product-rate d-inline-block">
                                        <div class="product-rating" style="width: 80%"></div>
                                    </div>
                                    <div class="product-price">
                                        @if (!empty($product->price->discount_price))
                                            <span class="old-price">${{ $product->price->selling_price }}</span>
                                            <span>{{ $product->price->discount_price }}Ks</span>
                                        @else
                                            <span>{{ $product->price->selling_price }}Ks</span>
                                        @endif
                                    </div>

                                    <div class="d-flex justify-content-cente mt-2">
                                        <a href="shop-cart.html" class="btn btn-primary text-center w-100 custom-button hover-up">
                                            <i class="fi-rs-shopping-cart mr-2"></i>Add
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach

                    <!--end product card-->
                </div>
                <!--En tab seven-->
            </div>
            <!--End tab-content-->
        </div>
    </section>
    <!--Products Tabs-->

    <section class="section-padding pb-5">
        <div class="container">
            <div class="section-title wow animate__animated animate__fadeIn">
                <h3 class=""> Featured Products </h3>

            </div>
            <div class="row">
                <div class="col-lg-3 d-none d-lg-flex wow animate__animated animate__fadeIn">
                    <div class="banner-img style-2">
                        <div class="banner-text">
                            <h2 class="mb-100">Bring best into your home</h2>
                            <a href="shop-grid-right.html" class="btn btn-xs">Shop Now <i class="fi-rs-arrow-small-right"></i></a>
                        </div>
                    </div>
                </div>
                <div class="col-lg-9 col-md-12 wow animate__animated animate__fadeIn" data-wow-delay=".4s">
                    <div class="tab-content" id="myTabContent-1">
                        <div class="tab-pane fade show active" id="tab-one-1" role="tabpanel" aria-labelledby="tab-one-1">
                            <div class="carausel-4-columns-cover arrow-center position-relative">
                                <div class="slider-arrow slider-arrow-2 carausel-4-columns-arrow" id="carausel-4-columns-arrows"></div>
                                <div class="carausel-4-columns carausel-arrow-center" id="carausel-4-columns">
                                    @foreach ($featureProducts as $product)
                                        <div class="product-cart-wrap">
                                            <div class="product-img-action-wrap">
                                                <div class="product-img product-img-zoom">
                                                    <a href="shop-product-right.html">
                                                        <img class="default-img" src="{{ !empty($product->product_photo) ? url('upload/product_images/' . $product->product_photo) : url('frontend/8ray/imgs/shop/product-1-2.jpg') }}" alt="" />

                                                        @php
                                                            $multiImage = $product->multiImages->first();
                                                        @endphp
                                                        <img class="hover-img" src="{{ !empty($multiImage) ? url('upload/product_multi_images/' . $multiImage->photo_name) : url('frontend/8ray/imgs/shop/product-1-2.jpg') }}" alt="" />
                                                    </a>
                                                </div>
                                                <div class="product-action-1">
                                                    <a aria-label="Quick view" class="action-btn small hover-up" data-bs-toggle="modal" data-bs-target="#quickViewModal"> <i class="fi-rs-eye"></i></a>
                                                    <a aria-label="Add To Wishlist" class="action-btn small hover-up" href="shop-wishlist.html"><i class="fi-rs-heart"></i></a>
                                                    <a aria-label="Compare" class="action-btn small hover-up" href="shop-compare.html"><i class="fi-rs-shuffle"></i></a>
                                                </div>
                                                <div class="product-badges product-badges-position product-badges-mrg">
                                                    @if ($product->productInfo)
                                                        @if ($product->productInfo->best_sale)
                                                            <span class="best">Best Sale</span>
                                                        @endif
                                                    @endif
                                                </div>
                                            </div>
                                            <div class="product-content-wrap">
                                                <div class="product-category">
                                                    @foreach ($product->brands as $category)
                                                        <a href="shop-grid-right.html">{{ $category->brand_name }}</a>
                                                    @endforeach
                                                </div>
                                                <h2><a href="shop-product-right.html">{{ $product->product_name }}</a></h2>
                                                <div class="product-rate d-inline-block">
                                                    <div class="product-rating" style="width: 80%"></div>
                                                </div>
                                                <div class="product-price mt-10">
                                                    @if (!empty($product->price->discount_price))
                                                        <span class="old-price">${{ $product->price->selling_price }}</span>
                                                        <span>{{ $product->price->discount_price }}Ks</span>
                                                    @else
                                                        <span>{{ $product->price->selling_price }}Ks</span>
                                                    @endif
                                                </div>
                                                <div class="sold mt-15 mb-15">
                                                    <div class="progress mb-5">
                                                        <div class="progress-bar" role="progressbar" style="width: 50%" aria-valuemin="0" aria-valuemax="100"></div>
                                                    </div>
                                                    <span class="font-xs text-heading"> Sold: 90/120</span>
                                                </div>
                                                <div class="d-flex justify-content-cente mt-2">
                                                    <a href="shop-cart.html" class="btn btn-primary text-center w-100 custom-button hover-up">
                                                        <i class="fi-rs-shopping-cart mr-2"></i>Add
                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                        <!--End product Wrap-->
                                    @endforeach


                                </div>
                            </div>
                        </div>
                        <!--End tab-pane-->


                    </div>
                    <!--End tab-content-->
                </div>
                <!--End Col-lg-9-->
            </div>
        </div>
    </section>
    <!--End Best Sales-->

    <!-- TV Category -->

    <section class="product-tabs section-padding position-relative">
            <div class="container">
                <div class="section-title style-2 wow animate__animated animate__fadeIn">
                    <h3>Live Sale, Vlogging, Game Streaming </h3>

                </div>
                <!--End nav-tabs-->
                <div class="tab-content" id="myTabContent">
                    <div class="tab-pane fade show active" id="tab-one" role="tabpanel" aria-labelledby="tab-one">
                        <div class="row product-grid-4">
                            @foreach ($productCategories as $product)
                                <div class="col-lg-2 col-md-3 col-6 col-sm-6">
                                    <div class="product-cart-wrap mb-30 wow animate__animated animate__fadeIn" data-wow-delay=".1s">
                                        <div class="product-img-action-wrap">
                                            <div class="product-img product-img-zoom">
                                                <a href="shop-product-right.html">
                                                    <img class="default-img" src="{{ !empty($product->product_photo) ? url('upload/product_images/' . $product->product_photo) : url('frontend/8ray/imgs/shop/product-1-2.jpg') }}" alt="" />

                                                    @php
                                                        $multiImage = $product->multiImages->first();
                                                    @endphp
                                                    <img class="hover-img" src="{{ !empty($multiImage) ? url('upload/product_multi_images/' . $multiImage->photo_name) : url('frontend/8ray/imgs/shop/product-1-2.jpg') }}" alt="" />
                                                </a>
                                            </div>
                                            <div class="product-action-1">
                                                <a aria-label="Quick view" class="action-btn small hover-up" data-bs-toggle="modal" data-bs-target="#quickViewModal"> <i class="fi-rs-eye"></i></a>
                                                <a aria-label="Add To Wishlist" class="action-btn small hover-up" href="shop-wishlist.html"><i class="fi-rs-heart"></i></a>
                                                <a aria-label="Compare" class="action-btn small hover-up" href="shop-compare.html"><i class="fi-rs-shuffle"></i></a>
                                            </div>
                                            <div class="product-badges product-badges-position product-badges-mrg">
                                                @if ($product->productInfo)
                                                    @if ($product->productInfo->best_sale)
                                                        <span class="best">Best Sale</span>
                                                    @endif
                                                @endif
                                            </div>
                                        </div>
                                        <div class="product-content-wrap">
                                            <div class="product-category">
                                                @foreach ($product->brands as $category)
                                                    <a href="shop-grid-right.html">{{ $category->brand_name }}</a>
                                                @endforeach
                                            </div>
                                            <h2><a href="shop-product-right.html">{{ $product->product_name }}</a></h2>
                                            <div class="product-rate d-inline-block">
                                                <div class="product-rating" style="width: 80%"></div>
                                            </div>
                                            <div class="product-price">
                                                @if (!empty($product->price->discount_price))
                                                    <span class="old-price">${{ $product->price->selling_price }}</span>
                                                    <span>{{ $product->price->discount_price }}Ks</span>
                                                @else
                                                    <span>{{ $product->price->selling_price }}Ks</span>
                                                @endif
                                            </div>
                                            <div class="d-flex justify-content-cente mt-2">
                                                <a href="shop-cart.html" class="btn btn-primary text-center w-100 custom-button hover-up">
                                                    <i class="fi-rs-shopping-cart mr-2"></i>Add
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!--end product card-->
                            @endforeach


                        </div>
                        <!--End product-grid-4-->
                    </div>


                </div>
                <!--End tab-content-->
            </div>


    </section>
    <!--End TV Category -->

    <!-- Tshirt Category -->

    <section class="product-tabs section-padding position-relative">
            <div class="container">
                <div class="section-title style-2 wow animate__animated animate__fadeIn">
                    <h3>Sound Product Collection</h3>

                </div>
                <!--End nav-tabs-->
                <div class="tab-content" id="myTabContent">
                    <div class="tab-pane fade show active" id="tab-one" role="tabpanel" aria-labelledby="tab-one">
                        <div class="row product-grid-4">

                            @foreach ($soundProductCategories as $product)
                                <div class="col-lg-2 col-md-3 col-6 col-sm-6">
                                    <div class="product-cart-wrap mb-30 wow animate__animated animate__fadeIn" data-wow-delay=".1s">
                                        <div class="product-img-action-wrap">
                                            <div class="product-img product-img-zoom">
                                                <a href="shop-product-right.html">
                                                    <img class="default-img" src="{{ !empty($product->product_photo) ? url('upload/product_images/' . $product->product_photo) : url('frontend/8ray/imgs/shop/product-1-2.jpg') }}" alt="" />

                                                    @php
                                                        $multiImage = $product->multiImages->first();
                                                    @endphp
                                                    <img class="hover-img" src="{{ !empty($multiImage) ? url('upload/product_multi_images/' . $multiImage->photo_name) : url('frontend/8ray/imgs/shop/product-1-2.jpg') }}" alt="" />
                                                </a>
                                            </div>
                                            <div class="product-action-1">
                                                <a aria-label="Quick view" class="action-btn small hover-up" data-bs-toggle="modal" data-bs-target="#quickViewModal"> <i class="fi-rs-eye"></i></a>
                                                <a aria-label="Add To Wishlist" class="action-btn small hover-up" href="shop-wishlist.html"><i class="fi-rs-heart"></i></a>
                                                <a aria-label="Compare" class="action-btn small hover-up" href="shop-compare.html"><i class="fi-rs-shuffle"></i></a>
                                            </div>
                                            <div class="product-badges product-badges-position product-badges-mrg">
                                                @if ($product->productInfo)
                                                    @if ($product->productInfo->best_sale)
                                                        <span class="best">Best Sale</span>
                                                    @endif
                                                @endif
                                            </div>
                                        </div>
                                        <div class="product-content-wrap">
                                            <div class="product-category">
                                                @foreach ($product->brands as $category)
                                                    <a href="shop-grid-right.html">{{ $category->brand_name }}</a>
                                                @endforeach
                                            </div>
                                            <h2><a href="shop-product-right.html">{{ $product->product_name }}</a></h2>
                                            <div class="product-rate d-inline-block">
                                                <div class="product-rating" style="width: 80%"></div>
                                            </div>
                                            <div class="product-price">
                                                @if (!empty($product->price->discount_price))
                                                    <span class="old-price">${{ $product->price->selling_price }}</span>
                                                    <span>{{ $product->price->discount_price }}Ks</span>
                                                @else
                                                    <span>{{ $product->price->selling_price }}Ks</span>
                                                @endif
                                            </div>
                                            <div class="d-flex justify-content-cente mt-2">
                                                <a href="shop-cart.html" class="btn btn-primary text-center w-100 custom-button hover-up">
                                                    <i class="fi-rs-shopping-cart mr-2"></i>Add
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!--end product card-->
                            @endforeach

                        </div>
                        <!--End product-grid-4-->
                    </div>


                </div>
                <!--End tab-content-->
            </div>


    </section>
    <!--End Tshirt Category -->

    <!-- Computer Category -->

    <section class="product-tabs section-padding position-relative">
        <div class="container">
            <div class="section-title style-2 wow animate__animated animate__fadeIn">
                <h3>Product Photography </h3>

            </div>
            <!--End nav-tabs-->
            <div class="tab-content" id="myTabContent">
                <div class="tab-pane fade show active" id="tab-one" role="tabpanel" aria-labelledby="tab-one">
                    <div class="row product-grid-4">

                        @foreach ($productPhotographys as $product)
                        <div class="col-lg-2 col-md-3 col-6 col-sm-6">
                            <div class="product-cart-wrap mb-30 wow animate__animated animate__fadeIn" data-wow-delay=".1s">
                                <div class="product-img-action-wrap">
                                    <div class="product-img product-img-zoom">
                                        <a href="shop-product-right.html">
                                            <img class="default-img" src="{{ !empty($product->product_photo) ? url('upload/product_images/' . $product->product_photo) : url('frontend/8ray/imgs/shop/product-1-2.jpg') }}" alt="" />

                                            @php
                                                $multiImage = $product->multiImages->first();
                                            @endphp
                                            <img class="hover-img" src="{{ !empty($multiImage) ? url('upload/product_multi_images/' . $multiImage->photo_name) : url('frontend/8ray/imgs/shop/product-1-2.jpg') }}" alt="" />
                                        </a>
                                    </div>
                                    <div class="product-action-1">
                                        <a aria-label="Quick view" class="action-btn small hover-up" data-bs-toggle="modal" data-bs-target="#quickViewModal"> <i class="fi-rs-eye"></i></a>
                                        <a aria-label="Add To Wishlist" class="action-btn small hover-up" href="shop-wishlist.html"><i class="fi-rs-heart"></i></a>
                                        <a aria-label="Compare" class="action-btn small hover-up" href="shop-compare.html"><i class="fi-rs-shuffle"></i></a>
                                    </div>
                                    <div class="product-badges product-badges-position product-badges-mrg">
                                        @if ($product->productInfo)
                                            @if ($product->productInfo->best_sale)
                                                <span class="best">Best Sale</span>
                                            @endif
                                        @endif
                                    </div>
                                </div>
                                <div class="product-content-wrap">
                                    <div class="product-category">
                                        @foreach ($product->brands as $category)
                                            <a href="shop-grid-right.html">{{ $category->brand_name }}</a>
                                        @endforeach
                                    </div>
                                    <h2><a href="shop-product-right.html">{{ $product->product_name }}</a></h2>
                                    <div class="product-rate d-inline-block">
                                        <div class="product-rating" style="width: 80%"></div>
                                    </div>
                                    <div class="product-price">
                                        @if (!empty($product->price->discount_price))
                                            <span class="old-price">${{ $product->price->selling_price }}</span>
                                            <span>{{ $product->price->discount_price }}Ks</span>
                                        @else
                                            <span>{{ $product->price->selling_price }}Ks</span>
                                        @endif
                                    </div>
                                    <div class="d-flex justify-content-cente mt-2">
                                        <a href="shop-cart.html" class="btn btn-primary text-center w-100 custom-button hover-up">
                                            <i class="fi-rs-shopping-cart mr-2"></i>Add
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!--end product card-->
                        @endforeach

                    </div>
                    <!--End product-grid-4-->
                </div>


            </div>
            <!--End tab-content-->
        </div>


    </section>
    <!--End Computer Category -->

    <!--Start category slider-->
    <section class="popular-categories section-padding">
        <div class="container wow animate__animated animate__fadeIn">
            <div class="section-title">
                <div class="title">
                    <h3>Brand Zone</h3>
                </div>
                <div class="slider-arrow slider-arrow-2 flex-right carausel-10-columns-arrow" id="carausel-10-columns-arrows"></div>
            </div>
            <div class="carausel-10-columns-cover position-relative">
                <div class="carausel-10-columns" id="carausel-10-columns">
                    @php
                        $brands = App\Models\Brand::where('id', '<>', 1)
                ->withCount('products') // Count the number of related products
                ->orderByDesc('updated_at')
                ->orderBy('brand_name')
                ->get();

                    @endphp
                    @foreach($brands as $brand)
                    <div class="card-2 bg-9 wow animate__animated animate__fadeInUp" data-wow-delay=".1s">
                        <figure class="img-hover-scale overflow-hidden">
                            <a href="shop-grid-right.html">
                                <img src="{{ !empty($brand->brand_image) ? url('upload/brand_images/' . $brand->brand_image) : url('upload/profile.jpg') }}"
                                alt="{{ $brand->brand_name }}">
                            </a>
                        </figure>
                        <h6><a href="shop-grid-right.html">{{ $brand->brand_name }}</a></h6>
                       <span>{{ $brand->products_count }} items</span>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
    </section>
    <!--End category slider-->

</main>

@endsection
