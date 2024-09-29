@extends('frontend.8ray.layout.layout')

@section('8ray')

<main class="main">

    @php
        use Illuminate\Support\Str;
    @endphp

    @php
        $categories = App\Models\ProductCategory::orderBy('product_category_name', 'ASC')->get();
    @endphp

    @php
        $categoryIds = [2, 3, 4, 5];
        $categorySlug = implode(',', $categoryIds); // Create a comma-separated string
    @endphp

    <!--Start banners -->
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
                            <a href="{{ url('product/category/'.$categorySlug.'/multiple-categories') }}" class="btn btn-xs">
                                Shop Now
                                <i class="fi-rs-arrow-small-right"></i>
                                </a>
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
                            @foreach($categories as $category)
                                @if($category->id == 8)
                                    <a href="{{ url('product/category/'.$category->id.'/'.$category->product_category_slug) }}" class="btn btn-xs">
                                        Shop Now
                                        <i class="fi-rs-arrow-small-right"></i>
                                    </a>
                                @endif
                            @endforeach
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 d-md-none d-lg-flex">
                    <div class="banner-img mb-sm-0 wow animate__animated animate__fadeInUp" data-wow-delay=".4s">
                        <img src="{{ url('frontend/8ray/imgs/banner/banner-2.png') }}" alt="" />
                        <div class="banner-text">
                            <h4>CCTV &<br />
                                security system <br />Accessories</h4>

                                @foreach($categories as $category)
                                    @if($category->id == 11)
                                        <a href="{{ url('product/category/'.$category->id.'/'.$category->product_category_slug) }}" class="btn btn-xs">
                                            Shop Now
                                            <i class="fi-rs-arrow-small-right"></i>
                                        </a>
                                    @endif
                                @endforeach

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- End banners-->

    <section class="product-tabs section-padding position-relative">
        <div class="container">
            <div class="section-title style-2 wow animate__animated animate__fadeIn">
                <h3> New Product of The Month </h3>
            </div>
            <!--End nav-tabs-->
            <div class="tab-content" id="myTabContent">
                <div class="row product-grid-4">
                    <!--end product card-->
                    @php
                        $products = App\Models\Product::orderBy('product_name', 'ASC')->get();
                    @endphp

                    @foreach ($products as $product)
                        @if($product->id == 149)
                            <div class="col-lg-2 col-md-3 col-6 col-sm-6">
                                <div class="product-cart-wrap mb-30 wow animate__animated animate__fadeIn card-container" data-wow-delay=".1s">
                                    <div class="product-img-action-wrap">
                                        <div class="product-img product-img-zoom">
                                            <a href="{{ url('product/details/'.$product->id.'/'.$product->product_slug) }}">
                                                <img class="default-img" src="{{ !empty($product->product_photo) ? url('upload/product_images/' . $product->product_photo) : url('frontend/8ray/imgs/shop/product-1-2.jpg') }}" alt="" />

                                                @php
                                                    $multiImage = $product->multiImages->first();
                                                @endphp
                                                <img class="hover-img" src="{{ !empty($multiImage) ? url('upload/product_multi_images/' . $multiImage->photo_name) : url('frontend/8ray/imgs/shop/product-1-2.jpg') }}" alt="" />
                                            </a>
                                        </div>
                                        <div class="product-action-1" id="product-action-1">
                                            <a aria-label="Add To Wishlist" class="action-btn" id="{{ $product->id }}" onclick="addToWishList(this.id)"  >
                                                <i class="fi-rs-heart"></i>
                                            </a>
                                            <a aria-label="Compare" class="action-btn"  id="{{ $product->id }}" onclick="addToCompare(this.id)">
                                                <i class="fi-rs-shuffle"></i>
                                            </a>
                                            <a aria-label="Quick view" class="action-btn small hover-up" data-bs-toggle="modal" data-bs-target="#quickViewModal" id="{{ $product->id }}" onclick="productView(this.id)"> <i class="fi-rs-eye"></i></a>
                                        </div>
                                        <div class="product-badges product-badges-position product-badges-mrg">
                                            @if ($product->productInfo)
                                                @if ($product->productInfo->new)
                                                    <span class="new">New</span>
                                                @elseif ($product->productInfo->hot)
                                                    <span class="hot">Hot</span>
                                                @elseif ($product->productInfo->sale)
                                                    <span class="sale">Sale</span>
                                                @elseif ($product->productInfo->best_sale)
                                                    <span class="best">Best Sale</span>
                                                @endif
                                            @endif
                                        </div>
                                    </div>
                                    <div class="product-content-wrap">
                                        <div class="product-category">
                                            @foreach ($product->brands as $brand)
                                            <a href="{{ url('product/brandzone/'.$brand->id.'/'.$brand->brand_slug) }}">
                                                {{ Str::limit($brand->brand_name, 25) }}
                                            </a>
                                            @endforeach
                                        </div>
                                        <h2><a href="{{ url('product/details/'.$product->id.'/'.$product->product_slug) }}">{{ Str::limit($product->product_name, 15) }}</a></h2>
                                        <div class="product-price">
                                            @if (!empty($product->price->discount_price) && $product->price->discount_price > 0)
                                                <span class="old-price">${{ $product->price->selling_price }}</span>
                                                <span>
                                                    @php
                                                        $finalPrice = $product->price->selling_price - $product->price->discount_price;
                                                    @endphp
                                                    {{ $finalPrice }}Ks
                                                </span>
                                            @else
                                                <span>{{ $product->price->selling_price }}Ks</span>
                                            @endif
                                        </div>

                                        <div class="d-flex justify-content-center mt-2">
                                            <a href="{{ url('product/details/'.$product->id.'/'.$product->product_slug) }}" class="btn btn-primary text-center w-100 custom-button hover-up">
                                                View Detail
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endif
                    @endforeach

                    @foreach ($products as $product)
                        @if($product->id == 135)
                            <div class="col-lg-2 col-md-3 col-6 col-sm-6">
                                <div class="product-cart-wrap mb-30 wow animate__animated animate__fadeIn card-container" data-wow-delay=".1s">
                                    <div class="product-img-action-wrap">
                                        <div class="product-img product-img-zoom">
                                            <a href="{{ url('product/details/'.$product->id.'/'.$product->product_slug) }}">
                                                <img class="default-img" src="{{ !empty($product->product_photo) ? url('upload/product_images/' . $product->product_photo) : url('frontend/8ray/imgs/shop/product-1-2.jpg') }}" alt="" />

                                                @php
                                                    $multiImage = $product->multiImages->first();
                                                @endphp
                                                <img class="hover-img" src="{{ !empty($multiImage) ? url('upload/product_multi_images/' . $multiImage->photo_name) : url('frontend/8ray/imgs/shop/product-1-2.jpg') }}" alt="" />
                                            </a>
                                        </div>
                                        <div class="product-action-1" id="product-action-1">
                                            <a aria-label="Add To Wishlist" class="action-btn" id="{{ $product->id }}" onclick="addToWishList(this.id)"  >
                                                <i class="fi-rs-heart"></i>
                                            </a>
                                            <a aria-label="Compare" class="action-btn"  id="{{ $product->id }}" onclick="addToCompare(this.id)">
                                                <i class="fi-rs-shuffle"></i>
                                            </a>
                                            <a aria-label="Quick view" class="action-btn small hover-up" data-bs-toggle="modal" data-bs-target="#quickViewModal" id="{{ $product->id }}" onclick="productView(this.id)"> <i class="fi-rs-eye"></i></a>
                                        </div>
                                        <div class="product-badges product-badges-position product-badges-mrg">
                                            @if ($product->productInfo)
                                                @if ($product->productInfo->new)
                                                    <span class="new">New</span>
                                                @elseif ($product->productInfo->hot)
                                                    <span class="hot">Hot</span>
                                                @elseif ($product->productInfo->sale)
                                                    <span class="sale">Sale</span>
                                                @elseif ($product->productInfo->best_sale)
                                                    <span class="best">Best Sale</span>
                                                @endif
                                            @endif
                                        </div>
                                    </div>
                                    <div class="product-content-wrap">
                                        <div class="product-category">
                                            @foreach ($product->brands as $brand)
                                            <a href="{{ url('product/brandzone/'.$brand->id.'/'.$brand->brand_slug) }}">
                                                {{ Str::limit($brand->brand_name, 25) }}
                                            </a>
                                            @endforeach
                                        </div>
                                        <h2><a href="{{ url('product/details/'.$product->id.'/'.$product->product_slug) }}">{{ Str::limit($product->product_name, 15) }}</a></h2>
                                        <div class="product-price">
                                            @if (!empty($product->price->discount_price) && $product->price->discount_price > 0)
                                                <span class="old-price">${{ $product->price->selling_price }}</span>
                                                <span>
                                                    @php
                                                        $finalPrice = $product->price->selling_price - $product->price->discount_price;
                                                    @endphp
                                                    {{ $finalPrice }}Ks
                                                </span>
                                            @else
                                                <span>{{ $product->price->selling_price }}Ks</span>
                                            @endif
                                        </div>

                                        <div class="d-flex justify-content-center mt-2">
                                            <a href="{{ url('product/details/'.$product->id.'/'.$product->product_slug) }}" class="btn btn-primary text-center w-100 custom-button hover-up">
                                                View Detail
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endif
                    @endforeach

                    @foreach ($products as $product)
                        @if($product->id == 140)
                            <div class="col-lg-2 col-md-3 col-6 col-sm-6">
                                <div class="product-cart-wrap mb-30 wow animate__animated animate__fadeIn card-container" data-wow-delay=".1s">
                                    <div class="product-img-action-wrap">
                                        <div class="product-img product-img-zoom">
                                            <a href="{{ url('product/details/'.$product->id.'/'.$product->product_slug) }}">
                                                <img class="default-img" src="{{ !empty($product->product_photo) ? url('upload/product_images/' . $product->product_photo) : url('frontend/8ray/imgs/shop/product-1-2.jpg') }}" alt="" />

                                                @php
                                                    $multiImage = $product->multiImages->first();
                                                @endphp
                                                <img class="hover-img" src="{{ !empty($multiImage) ? url('upload/product_multi_images/' . $multiImage->photo_name) : url('frontend/8ray/imgs/shop/product-1-2.jpg') }}" alt="" />
                                            </a>
                                        </div>
                                        <div class="product-action-1" id="product-action-1">
                                            <a aria-label="Add To Wishlist" class="action-btn" id="{{ $product->id }}" onclick="addToWishList(this.id)"  >
                                                <i class="fi-rs-heart"></i>
                                            </a>
                                            <a aria-label="Compare" class="action-btn"  id="{{ $product->id }}" onclick="addToCompare(this.id)">
                                                <i class="fi-rs-shuffle"></i>
                                            </a>
                                            <a aria-label="Quick view" class="action-btn small hover-up" data-bs-toggle="modal" data-bs-target="#quickViewModal" id="{{ $product->id }}" onclick="productView(this.id)"> <i class="fi-rs-eye"></i></a>
                                        </div>
                                        <div class="product-badges product-badges-position product-badges-mrg">
                                            @if ($product->productInfo)
                                                @if ($product->productInfo->new)
                                                    <span class="new">New</span>
                                                @elseif ($product->productInfo->hot)
                                                    <span class="hot">Hot</span>
                                                @elseif ($product->productInfo->sale)
                                                    <span class="sale">Sale</span>
                                                @elseif ($product->productInfo->best_sale)
                                                    <span class="best">Best Sale</span>
                                                @endif
                                            @endif
                                        </div>
                                    </div>
                                    <div class="product-content-wrap">
                                        <div class="product-category">
                                            @foreach ($product->brands as $brand)
                                            <a href="{{ url('product/brandzone/'.$brand->id.'/'.$brand->brand_slug) }}">
                                                {{ Str::limit($brand->brand_name, 25) }}
                                            </a>
                                            @endforeach
                                        </div>
                                        <h2><a href="{{ url('product/details/'.$product->id.'/'.$product->product_slug) }}">{{ Str::limit($product->product_name, 15) }}</a></h2>
                                        <div class="product-price">
                                            @if (!empty($product->price->discount_price) && $product->price->discount_price > 0)
                                                <span class="old-price">${{ $product->price->selling_price }}</span>
                                                <span>
                                                    @php
                                                        $finalPrice = $product->price->selling_price - $product->price->discount_price;
                                                    @endphp
                                                    {{ $finalPrice }}Ks
                                                </span>
                                            @else
                                                <span>{{ $product->price->selling_price }}Ks</span>
                                            @endif
                                        </div>

                                        <div class="d-flex justify-content-center mt-2">
                                            <a href="{{ url('product/details/'.$product->id.'/'.$product->product_slug) }}" class="btn btn-primary text-center w-100 custom-button hover-up">
                                                View Detail
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endif
                    @endforeach

                    @foreach ($products as $product)
                        @if($product->id == 153)
                            <div class="col-lg-2 col-md-3 col-6 col-sm-6">
                                <div class="product-cart-wrap mb-30 wow animate__animated animate__fadeIn card-container" data-wow-delay=".1s">
                                    <div class="product-img-action-wrap">
                                        <div class="product-img product-img-zoom">
                                            <a href="{{ url('product/details/'.$product->id.'/'.$product->product_slug) }}">
                                                <img class="default-img" src="{{ !empty($product->product_photo) ? url('upload/product_images/' . $product->product_photo) : url('frontend/8ray/imgs/shop/product-1-2.jpg') }}" alt="" />

                                                @php
                                                    $multiImage = $product->multiImages->first();
                                                @endphp
                                                <img class="hover-img" src="{{ !empty($multiImage) ? url('upload/product_multi_images/' . $multiImage->photo_name) : url('frontend/8ray/imgs/shop/product-1-2.jpg') }}" alt="" />
                                            </a>
                                        </div>
                                        <div class="product-action-1" id="product-action-1">
                                            <a aria-label="Add To Wishlist" class="action-btn" id="{{ $product->id }}" onclick="addToWishList(this.id)"  >
                                                <i class="fi-rs-heart"></i>
                                            </a>
                                            <a aria-label="Compare" class="action-btn"  id="{{ $product->id }}" onclick="addToCompare(this.id)">
                                                <i class="fi-rs-shuffle"></i>
                                            </a>
                                            <a aria-label="Quick view" class="action-btn small hover-up" data-bs-toggle="modal" data-bs-target="#quickViewModal" id="{{ $product->id }}" onclick="productView(this.id)"> <i class="fi-rs-eye"></i></a>
                                        </div>
                                        <div class="product-badges product-badges-position product-badges-mrg">
                                            @if ($product->productInfo)
                                                @if ($product->productInfo->new)
                                                    <span class="new">New</span>
                                                @elseif ($product->productInfo->hot)
                                                    <span class="hot">Hot</span>
                                                @elseif ($product->productInfo->sale)
                                                    <span class="sale">Sale</span>
                                                @elseif ($product->productInfo->best_sale)
                                                    <span class="best">Best Sale</span>
                                                @endif
                                            @endif
                                        </div>
                                    </div>
                                    <div class="product-content-wrap">
                                        <div class="product-category">
                                            @foreach ($product->brands as $brand)
                                            <a href="{{ url('product/brandzone/'.$brand->id.'/'.$brand->brand_slug) }}">
                                                {{ Str::limit($brand->brand_name, 25) }}
                                            </a>
                                            @endforeach
                                        </div>
                                        <h2><a href="{{ url('product/details/'.$product->id.'/'.$product->product_slug) }}">{{ Str::limit($product->product_name, 15) }}</a></h2>
                                        <div class="product-price">
                                            @if (!empty($product->price->discount_price) && $product->price->discount_price > 0)
                                                <span class="old-price">${{ $product->price->selling_price }}</span>
                                                <span>
                                                    @php
                                                        $finalPrice = $product->price->selling_price - $product->price->discount_price;
                                                    @endphp
                                                    {{ $finalPrice }}Ks
                                                </span>
                                            @else
                                                <span>{{ $product->price->selling_price }}Ks</span>
                                            @endif
                                        </div>

                                        <div class="d-flex justify-content-center mt-2">
                                            <a href="{{ url('product/details/'.$product->id.'/'.$product->product_slug) }}" class="btn btn-primary text-center w-100 custom-button hover-up">
                                                View Detail
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endif
                    @endforeach

                    @foreach ($products as $product)
                        @if($product->id == 15)
                            <div class="col-lg-2 col-md-3 col-6 col-sm-6">
                                <div class="product-cart-wrap mb-30 wow animate__animated animate__fadeIn card-container" data-wow-delay=".1s">
                                    <div class="product-img-action-wrap">
                                        <div class="product-img product-img-zoom">
                                            <a href="{{ url('product/details/'.$product->id.'/'.$product->product_slug) }}">
                                                <img class="default-img" src="{{ !empty($product->product_photo) ? url('upload/product_images/' . $product->product_photo) : url('frontend/8ray/imgs/shop/product-1-2.jpg') }}" alt="" />

                                                @php
                                                    $multiImage = $product->multiImages->first();
                                                @endphp
                                                <img class="hover-img" src="{{ !empty($multiImage) ? url('upload/product_multi_images/' . $multiImage->photo_name) : url('frontend/8ray/imgs/shop/product-1-2.jpg') }}" alt="" />
                                            </a>
                                        </div>
                                        <div class="product-action-1" id="product-action-1">
                                            <a aria-label="Add To Wishlist" class="action-btn" id="{{ $product->id }}" onclick="addToWishList(this.id)"  >
                                                <i class="fi-rs-heart"></i>
                                            </a>
                                            <a aria-label="Compare" class="action-btn"  id="{{ $product->id }}" onclick="addToCompare(this.id)">
                                                <i class="fi-rs-shuffle"></i>
                                            </a>
                                            <a aria-label="Quick view" class="action-btn small hover-up" data-bs-toggle="modal" data-bs-target="#quickViewModal" id="{{ $product->id }}" onclick="productView(this.id)"> <i class="fi-rs-eye"></i></a>
                                        </div>
                                        <div class="product-badges product-badges-position product-badges-mrg">
                                            @if ($product->productInfo)
                                                @if ($product->productInfo->new)
                                                    <span class="new">New</span>
                                                @elseif ($product->productInfo->hot)
                                                    <span class="hot">Hot</span>
                                                @elseif ($product->productInfo->sale)
                                                    <span class="sale">Sale</span>
                                                @elseif ($product->productInfo->best_sale)
                                                    <span class="best">Best Sale</span>
                                                @endif
                                            @endif
                                        </div>
                                    </div>
                                    <div class="product-content-wrap">
                                        <div class="product-category">
                                            @foreach ($product->brands as $brand)
                                            <a href="{{ url('product/brandzone/'.$brand->id.'/'.$brand->brand_slug) }}">
                                                {{ Str::limit($brand->brand_name, 25) }}
                                            </a>
                                            @endforeach
                                        </div>
                                        <h2><a href="{{ url('product/details/'.$product->id.'/'.$product->product_slug) }}">{{ Str::limit($product->product_name, 15) }}</a></h2>
                                        <div class="product-price">
                                            @if (!empty($product->price->discount_price) && $product->price->discount_price > 0)
                                                <span class="old-price">${{ $product->price->selling_price }}</span>
                                                <span>
                                                    @php
                                                        $finalPrice = $product->price->selling_price - $product->price->discount_price;
                                                    @endphp
                                                    {{ $finalPrice }}Ks
                                                </span>
                                            @else
                                                <span>{{ $product->price->selling_price }}Ks</span>
                                            @endif
                                        </div>

                                        <div class="d-flex justify-content-center mt-2">
                                            <a href="{{ url('product/details/'.$product->id.'/'.$product->product_slug) }}" class="btn btn-primary text-center w-100 custom-button hover-up">
                                                View Detail
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endif
                    @endforeach

                    @foreach ($products as $product)
                        @if($product->id == 16)
                            <div class="col-lg-2 col-md-3 col-6 col-sm-6">
                                <div class="product-cart-wrap mb-30 wow animate__animated animate__fadeIn card-container" data-wow-delay=".1s">
                                    <div class="product-img-action-wrap">
                                        <div class="product-img product-img-zoom">
                                            <a href="{{ url('product/details/'.$product->id.'/'.$product->product_slug) }}">
                                                <img class="default-img" src="{{ !empty($product->product_photo) ? url('upload/product_images/' . $product->product_photo) : url('frontend/8ray/imgs/shop/product-1-2.jpg') }}" alt="" />

                                                @php
                                                    $multiImage = $product->multiImages->first();
                                                @endphp
                                                <img class="hover-img" src="{{ !empty($multiImage) ? url('upload/product_multi_images/' . $multiImage->photo_name) : url('frontend/8ray/imgs/shop/product-1-2.jpg') }}" alt="" />
                                            </a>
                                        </div>
                                        <div class="product-action-1" id="product-action-1">
                                            <a aria-label="Add To Wishlist" class="action-btn" id="{{ $product->id }}" onclick="addToWishList(this.id)"  >
                                                <i class="fi-rs-heart"></i>
                                            </a>
                                            <a aria-label="Compare" class="action-btn"  id="{{ $product->id }}" onclick="addToCompare(this.id)">
                                                <i class="fi-rs-shuffle"></i>
                                            </a>
                                            <a aria-label="Quick view" class="action-btn small hover-up" data-bs-toggle="modal" data-bs-target="#quickViewModal" id="{{ $product->id }}" onclick="productView(this.id)"> <i class="fi-rs-eye"></i></a>
                                        </div>
                                        <div class="product-badges product-badges-position product-badges-mrg">
                                            @if ($product->productInfo)
                                                @if ($product->productInfo->new)
                                                    <span class="new">New</span>
                                                @elseif ($product->productInfo->hot)
                                                    <span class="hot">Hot</span>
                                                @elseif ($product->productInfo->sale)
                                                    <span class="sale">Sale</span>
                                                @elseif ($product->productInfo->best_sale)
                                                    <span class="best">Best Sale</span>
                                                @endif
                                            @endif
                                        </div>
                                    </div>
                                    <div class="product-content-wrap">
                                        <div class="product-category">
                                            @foreach ($product->brands as $brand)
                                            <a href="{{ url('product/brandzone/'.$brand->id.'/'.$brand->brand_slug) }}">
                                                {{ Str::limit($brand->brand_name, 25) }}
                                            </a>
                                            @endforeach
                                        </div>
                                        <h2><a href="{{ url('product/details/'.$product->id.'/'.$product->product_slug) }}">{{ Str::limit($product->product_name, 15) }}</a></h2>
                                        <div class="product-price">
                                            @if (!empty($product->price->discount_price) && $product->price->discount_price > 0)
                                                <span class="old-price">${{ $product->price->selling_price }}</span>
                                                <span>
                                                    @php
                                                        $finalPrice = $product->price->selling_price - $product->price->discount_price;
                                                    @endphp
                                                    {{ $finalPrice }}Ks
                                                </span>
                                            @else
                                                <span>{{ $product->price->selling_price }}Ks</span>
                                            @endif
                                        </div>

                                        <div class="d-flex justify-content-center mt-2">
                                            <a href="{{ url('product/details/'.$product->id.'/'.$product->product_slug) }}" class="btn btn-primary text-center w-100 custom-button hover-up">
                                                View Detail
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endif
                    @endforeach

                    @foreach ($products as $product)
                        @if($product->id == 32)
                            <div class="col-lg-2 col-md-3 col-6 col-sm-6">
                                <div class="product-cart-wrap mb-30 wow animate__animated animate__fadeIn card-container" data-wow-delay=".1s">
                                    <div class="product-img-action-wrap">
                                        <div class="product-img product-img-zoom">
                                            <a href="{{ url('product/details/'.$product->id.'/'.$product->product_slug) }}">
                                                <img class="default-img" src="{{ !empty($product->product_photo) ? url('upload/product_images/' . $product->product_photo) : url('frontend/8ray/imgs/shop/product-1-2.jpg') }}" alt="" />

                                                @php
                                                    $multiImage = $product->multiImages->first();
                                                @endphp
                                                <img class="hover-img" src="{{ !empty($multiImage) ? url('upload/product_multi_images/' . $multiImage->photo_name) : url('frontend/8ray/imgs/shop/product-1-2.jpg') }}" alt="" />
                                            </a>
                                        </div>
                                        <div class="product-action-1" id="product-action-1">
                                            <a aria-label="Add To Wishlist" class="action-btn" id="{{ $product->id }}" onclick="addToWishList(this.id)"  >
                                                <i class="fi-rs-heart"></i>
                                            </a>
                                            <a aria-label="Compare" class="action-btn"  id="{{ $product->id }}" onclick="addToCompare(this.id)">
                                                <i class="fi-rs-shuffle"></i>
                                            </a>
                                            <a aria-label="Quick view" class="action-btn small hover-up" data-bs-toggle="modal" data-bs-target="#quickViewModal" id="{{ $product->id }}" onclick="productView(this.id)"> <i class="fi-rs-eye"></i></a>
                                        </div>
                                        <div class="product-badges product-badges-position product-badges-mrg">
                                            @if ($product->productInfo)
                                                @if ($product->productInfo->new)
                                                    <span class="new">New</span>
                                                @elseif ($product->productInfo->hot)
                                                    <span class="hot">Hot</span>
                                                @elseif ($product->productInfo->sale)
                                                    <span class="sale">Sale</span>
                                                @elseif ($product->productInfo->best_sale)
                                                    <span class="best">Best Sale</span>
                                                @endif
                                            @endif
                                        </div>
                                    </div>
                                    <div class="product-content-wrap">
                                        <div class="product-category">
                                            @foreach ($product->brands as $brand)
                                            <a href="{{ url('product/brandzone/'.$brand->id.'/'.$brand->brand_slug) }}">
                                                {{ Str::limit($brand->brand_name, 25) }}
                                            </a>
                                            @endforeach
                                        </div>
                                        <h2><a href="{{ url('product/details/'.$product->id.'/'.$product->product_slug) }}">{{ Str::limit($product->product_name, 15) }}</a></h2>
                                        <div class="product-price">
                                            @if (!empty($product->price->discount_price) && $product->price->discount_price > 0)
                                                <span class="old-price">${{ $product->price->selling_price }}</span>
                                                <span>
                                                    @php
                                                        $finalPrice = $product->price->selling_price - $product->price->discount_price;
                                                    @endphp
                                                    {{ $finalPrice }}Ks
                                                </span>
                                            @else
                                                <span>{{ $product->price->selling_price }}Ks</span>
                                            @endif
                                        </div>

                                        <div class="d-flex justify-content-center mt-2">
                                            <a href="{{ url('product/details/'.$product->id.'/'.$product->product_slug) }}" class="btn btn-primary text-center w-100 custom-button hover-up">
                                                View Detail
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endif
                    @endforeach

                    @foreach ($products as $product)
                        @if($product->id == 53)
                            <div class="col-lg-2 col-md-3 col-6 col-sm-6">
                                <div class="product-cart-wrap mb-30 wow animate__animated animate__fadeIn card-container" data-wow-delay=".1s">
                                    <div class="product-img-action-wrap">
                                        <div class="product-img product-img-zoom">
                                            <a href="{{ url('product/details/'.$product->id.'/'.$product->product_slug) }}">
                                                <img class="default-img" src="{{ !empty($product->product_photo) ? url('upload/product_images/' . $product->product_photo) : url('frontend/8ray/imgs/shop/product-1-2.jpg') }}" alt="" />

                                                @php
                                                    $multiImage = $product->multiImages->first();
                                                @endphp
                                                <img class="hover-img" src="{{ !empty($multiImage) ? url('upload/product_multi_images/' . $multiImage->photo_name) : url('frontend/8ray/imgs/shop/product-1-2.jpg') }}" alt="" />
                                            </a>
                                        </div>
                                        <div class="product-action-1" id="product-action-1">
                                            <a aria-label="Add To Wishlist" class="action-btn" id="{{ $product->id }}" onclick="addToWishList(this.id)"  >
                                                <i class="fi-rs-heart"></i>
                                            </a>
                                            <a aria-label="Compare" class="action-btn"  id="{{ $product->id }}" onclick="addToCompare(this.id)">
                                                <i class="fi-rs-shuffle"></i>
                                            </a>
                                            <a aria-label="Quick view" class="action-btn small hover-up" data-bs-toggle="modal" data-bs-target="#quickViewModal" id="{{ $product->id }}" onclick="productView(this.id)"> <i class="fi-rs-eye"></i></a>
                                        </div>
                                        <div class="product-badges product-badges-position product-badges-mrg">
                                            @if ($product->productInfo)
                                                @if ($product->productInfo->new)
                                                    <span class="new">New</span>
                                                @elseif ($product->productInfo->hot)
                                                    <span class="hot">Hot</span>
                                                @elseif ($product->productInfo->sale)
                                                    <span class="sale">Sale</span>
                                                @elseif ($product->productInfo->best_sale)
                                                    <span class="best">Best Sale</span>
                                                @endif
                                            @endif
                                        </div>
                                    </div>
                                    <div class="product-content-wrap">
                                        <div class="product-category">
                                            @foreach ($product->brands as $brand)
                                            <a href="{{ url('product/brandzone/'.$brand->id.'/'.$brand->brand_slug) }}">
                                                {{ Str::limit($brand->brand_name, 25) }}
                                            </a>
                                            @endforeach
                                        </div>
                                        <h2><a href="{{ url('product/details/'.$product->id.'/'.$product->product_slug) }}">{{ Str::limit($product->product_name, 15) }}</a></h2>
                                        <div class="product-price">
                                            @if (!empty($product->price->discount_price) && $product->price->discount_price > 0)
                                                <span class="old-price">${{ $product->price->selling_price }}</span>
                                                <span>
                                                    @php
                                                        $finalPrice = $product->price->selling_price - $product->price->discount_price;
                                                    @endphp
                                                    {{ $finalPrice }}Ks
                                                </span>
                                            @else
                                                <span>{{ $product->price->selling_price }}Ks</span>
                                            @endif
                                        </div>

                                        <div class="d-flex justify-content-center mt-2">
                                            <a href="{{ url('product/details/'.$product->id.'/'.$product->product_slug) }}" class="btn btn-primary text-center w-100 custom-button hover-up">
                                                View Detail
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endif
                    @endforeach

                    @foreach ($products as $product)
                        @if($product->id == 55)
                            <div class="col-lg-2 col-md-3 col-6 col-sm-6">
                                <div class="product-cart-wrap mb-30 wow animate__animated animate__fadeIn card-container" data-wow-delay=".1s">
                                    <div class="product-img-action-wrap">
                                        <div class="product-img product-img-zoom">
                                            <a href="{{ url('product/details/'.$product->id.'/'.$product->product_slug) }}">
                                                <img class="default-img" src="{{ !empty($product->product_photo) ? url('upload/product_images/' . $product->product_photo) : url('frontend/8ray/imgs/shop/product-1-2.jpg') }}" alt="" />

                                                @php
                                                    $multiImage = $product->multiImages->first();
                                                @endphp
                                                <img class="hover-img" src="{{ !empty($multiImage) ? url('upload/product_multi_images/' . $multiImage->photo_name) : url('frontend/8ray/imgs/shop/product-1-2.jpg') }}" alt="" />
                                            </a>
                                        </div>
                                        <div class="product-action-1" id="product-action-1">
                                            <a aria-label="Add To Wishlist" class="action-btn" id="{{ $product->id }}" onclick="addToWishList(this.id)"  >
                                                <i class="fi-rs-heart"></i>
                                            </a>
                                            <a aria-label="Compare" class="action-btn"  id="{{ $product->id }}" onclick="addToCompare(this.id)">
                                                <i class="fi-rs-shuffle"></i>
                                            </a>
                                            <a aria-label="Quick view" class="action-btn small hover-up" data-bs-toggle="modal" data-bs-target="#quickViewModal" id="{{ $product->id }}" onclick="productView(this.id)"> <i class="fi-rs-eye"></i></a>
                                        </div>
                                        <div class="product-badges product-badges-position product-badges-mrg">
                                            @if ($product->productInfo)
                                                @if ($product->productInfo->new)
                                                    <span class="new">New</span>
                                                @elseif ($product->productInfo->hot)
                                                    <span class="hot">Hot</span>
                                                @elseif ($product->productInfo->sale)
                                                    <span class="sale">Sale</span>
                                                @elseif ($product->productInfo->best_sale)
                                                    <span class="best">Best Sale</span>
                                                @endif
                                            @endif
                                        </div>
                                    </div>
                                    <div class="product-content-wrap">
                                        <div class="product-category">
                                            @foreach ($product->brands as $brand)
                                            <a href="{{ url('product/brandzone/'.$brand->id.'/'.$brand->brand_slug) }}">
                                                {{ Str::limit($brand->brand_name, 25) }}
                                            </a>
                                            @endforeach
                                        </div>
                                        <h2><a href="{{ url('product/details/'.$product->id.'/'.$product->product_slug) }}">{{ Str::limit($product->product_name, 15) }}</a></h2>
                                        <div class="product-price">
                                            @if (!empty($product->price->discount_price) && $product->price->discount_price > 0)
                                                <span class="old-price">${{ $product->price->selling_price }}</span>
                                                <span>
                                                    @php
                                                        $finalPrice = $product->price->selling_price - $product->price->discount_price;
                                                    @endphp
                                                    {{ $finalPrice }}Ks
                                                </span>
                                            @else
                                                <span>{{ $product->price->selling_price }}Ks</span>
                                            @endif
                                        </div>

                                        <div class="d-flex justify-content-center mt-2">
                                            <a href="{{ url('product/details/'.$product->id.'/'.$product->product_slug) }}" class="btn btn-primary text-center w-100 custom-button hover-up">
                                                View Detail
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endif
                    @endforeach

                    @foreach ($products as $product)
                        @if($product->id == 27)
                            <div class="col-lg-2 col-md-3 col-6 col-sm-6">
                                <div class="product-cart-wrap mb-30 wow animate__animated animate__fadeIn card-container" data-wow-delay=".1s">
                                    <div class="product-img-action-wrap">
                                        <div class="product-img product-img-zoom">
                                            <a href="{{ url('product/details/'.$product->id.'/'.$product->product_slug) }}">
                                                <img class="default-img" src="{{ !empty($product->product_photo) ? url('upload/product_images/' . $product->product_photo) : url('frontend/8ray/imgs/shop/product-1-2.jpg') }}" alt="" />

                                                @php
                                                    $multiImage = $product->multiImages->first();
                                                @endphp
                                                <img class="hover-img" src="{{ !empty($multiImage) ? url('upload/product_multi_images/' . $multiImage->photo_name) : url('frontend/8ray/imgs/shop/product-1-2.jpg') }}" alt="" />
                                            </a>
                                        </div>
                                        <div class="product-action-1" id="product-action-1">
                                            <a aria-label="Add To Wishlist" class="action-btn" id="{{ $product->id }}" onclick="addToWishList(this.id)"  >
                                                <i class="fi-rs-heart"></i>
                                            </a>
                                            <a aria-label="Compare" class="action-btn"  id="{{ $product->id }}" onclick="addToCompare(this.id)">
                                                <i class="fi-rs-shuffle"></i>
                                            </a>
                                            <a aria-label="Quick view" class="action-btn small hover-up" data-bs-toggle="modal" data-bs-target="#quickViewModal" id="{{ $product->id }}" onclick="productView(this.id)"> <i class="fi-rs-eye"></i></a>
                                        </div>
                                        <div class="product-badges product-badges-position product-badges-mrg">
                                            @if ($product->productInfo)
                                                @if ($product->productInfo->new)
                                                    <span class="new">New</span>
                                                @elseif ($product->productInfo->hot)
                                                    <span class="hot">Hot</span>
                                                @elseif ($product->productInfo->sale)
                                                    <span class="sale">Sale</span>
                                                @elseif ($product->productInfo->best_sale)
                                                    <span class="best">Best Sale</span>
                                                @endif
                                            @endif
                                        </div>
                                    </div>
                                    <div class="product-content-wrap">
                                        <div class="product-category">
                                            @foreach ($product->brands as $brand)
                                            <a href="{{ url('product/brandzone/'.$brand->id.'/'.$brand->brand_slug) }}">
                                                {{ Str::limit($brand->brand_name, 25) }}
                                            </a>
                                            @endforeach
                                        </div>
                                        <h2><a href="{{ url('product/details/'.$product->id.'/'.$product->product_slug) }}">{{ Str::limit($product->product_name, 15) }}</a></h2>
                                        <div class="product-price">
                                            @if (!empty($product->price->discount_price) && $product->price->discount_price > 0)
                                                <span class="old-price">${{ $product->price->selling_price }}</span>
                                                <span>
                                                    @php
                                                        $finalPrice = $product->price->selling_price - $product->price->discount_price;
                                                    @endphp
                                                    {{ $finalPrice }}Ks
                                                </span>
                                            @else
                                                <span>{{ $product->price->selling_price }}Ks</span>
                                            @endif
                                        </div>

                                        <div class="d-flex justify-content-center mt-2">
                                            <a href="{{ url('product/details/'.$product->id.'/'.$product->product_slug) }}" class="btn btn-primary text-center w-100 custom-button hover-up">
                                                View Detail
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endif
                    @endforeach

                    @foreach ($products as $product)
                        @if($product->id == 136)
                            <div class="col-lg-2 col-md-3 col-6 col-sm-6">
                                <div class="product-cart-wrap mb-30 wow animate__animated animate__fadeIn card-container" data-wow-delay=".1s">
                                    <div class="product-img-action-wrap">
                                        <div class="product-img product-img-zoom">
                                            <a href="{{ url('product/details/'.$product->id.'/'.$product->product_slug) }}">
                                                <img class="default-img" src="{{ !empty($product->product_photo) ? url('upload/product_images/' . $product->product_photo) : url('frontend/8ray/imgs/shop/product-1-2.jpg') }}" alt="" />

                                                @php
                                                    $multiImage = $product->multiImages->first();
                                                @endphp
                                                <img class="hover-img" src="{{ !empty($multiImage) ? url('upload/product_multi_images/' . $multiImage->photo_name) : url('frontend/8ray/imgs/shop/product-1-2.jpg') }}" alt="" />
                                            </a>
                                        </div>
                                        <div class="product-action-1" id="product-action-1">
                                            <a aria-label="Add To Wishlist" class="action-btn" id="{{ $product->id }}" onclick="addToWishList(this.id)"  >
                                                <i class="fi-rs-heart"></i>
                                            </a>
                                            <a aria-label="Compare" class="action-btn"  id="{{ $product->id }}" onclick="addToCompare(this.id)">
                                                <i class="fi-rs-shuffle"></i>
                                            </a>
                                            <a aria-label="Quick view" class="action-btn small hover-up" data-bs-toggle="modal" data-bs-target="#quickViewModal" id="{{ $product->id }}" onclick="productView(this.id)"> <i class="fi-rs-eye"></i></a>
                                        </div>
                                        <div class="product-badges product-badges-position product-badges-mrg">
                                            @if ($product->productInfo)
                                                @if ($product->productInfo->new)
                                                    <span class="new">New</span>
                                                @elseif ($product->productInfo->hot)
                                                    <span class="hot">Hot</span>
                                                @elseif ($product->productInfo->sale)
                                                    <span class="sale">Sale</span>
                                                @elseif ($product->productInfo->best_sale)
                                                    <span class="best">Best Sale</span>
                                                @endif
                                            @endif
                                        </div>
                                    </div>
                                    <div class="product-content-wrap">
                                        <div class="product-category">
                                            @foreach ($product->brands as $brand)
                                            <a href="{{ url('product/brandzone/'.$brand->id.'/'.$brand->brand_slug) }}">
                                                {{ Str::limit($brand->brand_name, 25) }}
                                            </a>
                                            @endforeach
                                        </div>
                                        <h2><a href="{{ url('product/details/'.$product->id.'/'.$product->product_slug) }}">{{ Str::limit($product->product_name, 15) }}</a></h2>
                                        <div class="product-price">
                                            @if (!empty($product->price->discount_price) && $product->price->discount_price > 0)
                                                <span class="old-price">${{ $product->price->selling_price }}</span>
                                                <span>
                                                    @php
                                                        $finalPrice = $product->price->selling_price - $product->price->discount_price;
                                                    @endphp
                                                    {{ $finalPrice }}Ks
                                                </span>
                                            @else
                                                <span>{{ $product->price->selling_price }}Ks</span>
                                            @endif
                                        </div>

                                        <div class="d-flex justify-content-center mt-2">
                                            <a href="{{ url('product/details/'.$product->id.'/'.$product->product_slug) }}" class="btn btn-primary text-center w-100 custom-button hover-up">
                                                View Detail
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endif
                    @endforeach

                    @foreach ($products as $product)
                        @if($product->id == 152)
                            <div class="col-lg-2 col-md-3 col-6 col-sm-6">
                                <div class="product-cart-wrap mb-30 wow animate__animated animate__fadeIn card-container" data-wow-delay=".1s">
                                    <div class="product-img-action-wrap">
                                        <div class="product-img product-img-zoom">
                                            <a href="{{ url('product/details/'.$product->id.'/'.$product->product_slug) }}">
                                                <img class="default-img" src="{{ !empty($product->product_photo) ? url('upload/product_images/' . $product->product_photo) : url('frontend/8ray/imgs/shop/product-1-2.jpg') }}" alt="" />

                                                @php
                                                    $multiImage = $product->multiImages->first();
                                                @endphp
                                                <img class="hover-img" src="{{ !empty($multiImage) ? url('upload/product_multi_images/' . $multiImage->photo_name) : url('frontend/8ray/imgs/shop/product-1-2.jpg') }}" alt="" />
                                            </a>
                                        </div>
                                        <div class="product-action-1" id="product-action-1">
                                            <a aria-label="Add To Wishlist" class="action-btn" id="{{ $product->id }}" onclick="addToWishList(this.id)"  >
                                                <i class="fi-rs-heart"></i>
                                            </a>
                                            <a aria-label="Compare" class="action-btn"  id="{{ $product->id }}" onclick="addToCompare(this.id)">
                                                <i class="fi-rs-shuffle"></i>
                                            </a>
                                            <a aria-label="Quick view" class="action-btn small hover-up" data-bs-toggle="modal" data-bs-target="#quickViewModal" id="{{ $product->id }}" onclick="productView(this.id)"> <i class="fi-rs-eye"></i></a>
                                        </div>
                                        <div class="product-badges product-badges-position product-badges-mrg">
                                            @if ($product->productInfo)
                                                @if ($product->productInfo->new)
                                                    <span class="new">New</span>
                                                @elseif ($product->productInfo->hot)
                                                    <span class="hot">Hot</span>
                                                @elseif ($product->productInfo->sale)
                                                    <span class="sale">Sale</span>
                                                @elseif ($product->productInfo->best_sale)
                                                    <span class="best">Best Sale</span>
                                                @endif
                                            @endif
                                        </div>
                                    </div>
                                    <div class="product-content-wrap">
                                        <div class="product-category">
                                            @foreach ($product->brands as $brand)
                                            <a href="{{ url('product/brandzone/'.$brand->id.'/'.$brand->brand_slug) }}">
                                                {{ Str::limit($brand->brand_name, 25) }}
                                            </a>
                                            @endforeach
                                        </div>
                                        <h2><a href="{{ url('product/details/'.$product->id.'/'.$product->product_slug) }}">{{ Str::limit($product->product_name, 15) }}</a></h2>
                                        <div class="product-price">
                                            @if (!empty($product->price->discount_price) && $product->price->discount_price > 0)
                                                <span class="old-price">${{ $product->price->selling_price }}</span>
                                                <span>
                                                    @php
                                                        $finalPrice = $product->price->selling_price - $product->price->discount_price;
                                                    @endphp
                                                    {{ $finalPrice }}Ks
                                                </span>
                                            @else
                                                <span>{{ $product->price->selling_price }}Ks</span>
                                            @endif
                                        </div>

                                        <div class="d-flex justify-content-center mt-2">
                                            <a href="{{ url('product/details/'.$product->id.'/'.$product->product_slug) }}" class="btn btn-primary text-center w-100 custom-button hover-up">
                                                View Detail
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endif
                    @endforeach

                    <!--end product card-->
                </div>
                <!--En tab seven-->
            </div>
            <!--End tab-content-->
        </div>

    <section class="product-tabs section-padding position-relative">
        <div class="container">
            <div class="section-title style-2 wow animate__animated animate__fadeIn">
                <h3> Best Of Gadget </h3>
            </div>
            <!--End nav-tabs-->
            @php
                $brands = App\Models\Brand::orderBy('brand_name', 'ASC')->get();
            @endphp

            <div class="container">
                <div class="row">
                    <div class="col-lg-4 col-md-6" >

                        <div class="banner-img wow animate__animated animate__fadeInUp" data-wow-delay="0">
                            @foreach ($brands as $brand)
                                @if($brand->id == 7)
                                    <a href="{{ url('product/brandzone/'.$brand->id.'/'.$brand->brand_slug) }}">
                                        <img src="{{ url('frontend/8ray/imgs/banner/customer-1.jpg') }}" alt="" />
                                    </a>
                                @endif
                            @endforeach


                        </div>
                    </div>
                    <div class="col-lg-4 col-md-6">
                        <div class="banner-img wow animate__animated animate__fadeInUp" data-wow-delay=".2s">
                            @foreach ($brands as $brand)
                                @if($brand->id == 24)
                                    <a href="{{ url('product/brandzone/'.$brand->id.'/'.$brand->brand_slug) }}">
                                        <img src="{{ url('frontend/8ray/imgs/banner/customer-2.jpg') }}" alt="" />
                                    </a>
                                @endif
                            @endforeach
                        </div>
                    </div>
                    <div class="col-lg-4 d-md-none d-lg-flex">
                        <div class="banner-img mb-sm-0 wow animate__animated animate__fadeInUp" data-wow-delay=".3s">
                            @foreach ($brands as $brand)
                                @if($brand->id == 3)
                                    <a href="{{ url('product/brandzone/'.$brand->id.'/'.$brand->brand_slug) }}">
                                        <img src="{{ url('frontend/8ray/imgs/banner/customer-3.jpg') }}" alt="" />
                                    </a>
                                @endif
                            @endforeach
                        </div>
                    </div>
                    <div class="col-lg-4 d-md-none d-lg-flex">
                        <div class="banner-img mb-sm-0 wow animate__animated animate__fadeInUp" data-wow-delay=".4s">
                            @foreach ($brands as $brand)
                                @if($brand->id == 6)
                                    <a href="{{ url('product/brandzone/'.$brand->id.'/'.$brand->brand_slug) }}">
                                        <img src="{{ url('frontend/8ray/imgs/banner/customer-4.jpg') }}" alt="" />
                                    </a>
                                @endif
                            @endforeach
                        </div>
                    </div>
                    <div class="col-lg-4 d-md-none d-lg-flex">
                        <div class="banner-img mb-sm-0 wow animate__animated animate__fadeInUp" data-wow-delay=".5s">
                            @foreach ($brands as $brand)
                                @if($brand->id == 8)
                                    <a href="{{ url('product/brandzone/'.$brand->id.'/'.$brand->brand_slug) }}">
                                        <img src="{{ url('frontend/8ray/imgs/banner/customer-5.jpg') }}" alt="" />
                                    </a>
                                @endif
                            @endforeach
                        </div>
                    </div>
                    <div class="col-lg-4 d-md-none d-lg-flex">
                        <div class="banner-img mb-sm-0 wow animate__animated animate__fadeInUp" data-wow-delay=".6s">
                            @foreach ($brands as $brand)
                                @if($brand->id == 20)
                                    <a href="{{ url('product/brandzone/'.$brand->id.'/'.$brand->brand_slug) }}">
                                        <img src="{{ url('frontend/8ray/imgs/banner/customer-6.jpg') }}" alt="" />
                                    </a>
                                @endif
                            @endforeach
                        </div>
                    </div>

                </div>
            </div>
            <!--End tab-content-->
        </div>
    </section>
    <!--Products Tabs-->

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
                                        <a href="{{ url('product/details/'.$product->id.'/'.$product->product_slug) }}">
                                            <img class="default-img" src="{{ !empty($product->product_photo) ? url('upload/product_images/' . $product->product_photo) : url('frontend/8ray/imgs/shop/product-1-2.jpg') }}" alt="" />

                                            @php
                                                $multiImage = $product->multiImages->first();
                                            @endphp
                                            <img class="hover-img" src="{{ !empty($multiImage) ? url('upload/product_multi_images/' . $multiImage->photo_name) : url('frontend/8ray/imgs/shop/product-1-2.jpg') }}" alt="" />
                                        </a>
                                    </div>
                                    <div class="product-action-1" id="product-action-1">
                                        <a aria-label="Add To Wishlist" class="action-btn" id="{{ $product->id }}" onclick="addToWishList(this.id)"  >
                                            <i class="fi-rs-heart"></i>
                                        </a>
                                        <a aria-label="Compare" class="action-btn"  id="{{ $product->id }}" onclick="addToCompare(this.id)">
                                            <i class="fi-rs-shuffle"></i>
                                        </a>
                                        <a aria-label="Quick view" class="action-btn small hover-up" data-bs-toggle="modal" data-bs-target="#quickViewModal" id="{{ $product->id }}" onclick="productView(this.id)"> <i class="fi-rs-eye"></i></a>
                                    </div>
                                    <div class="product-badges product-badges-position product-badges-mrg">
                                        @if ($product->productInfo)
                                            @if ($product->productInfo->new)
                                                <span class="new">New</span>
                                            @elseif ($product->productInfo->hot)
                                                <span class="hot">Hot</span>
                                            @elseif ($product->productInfo->sale)
                                                <span class="sale">Sale</span>
                                            @elseif ($product->productInfo->best_sale)
                                                <span class="best">Best Sale</span>
                                            @endif
                                        @endif
                                    </div>
                                </div>
                                <div class="product-content-wrap">
                                    <div class="product-category">
                                        @foreach ($product->brands as $brand)
                                        <a href="{{ url('product/brandzone/'.$brand->id.'/'.$brand->brand_slug) }}">
                                            {{ Str::limit($brand->brand_name, 25) }}
                                        </a>
                                        @endforeach
                                    </div>
                                    <h2><a href="{{ url('product/details/'.$product->id.'/'.$product->product_slug) }}">{{ Str::limit($product->product_name, 15) }}</a></h2>
                                    <div class="product-price">
                                        @if (!empty($product->price->discount_price) && $product->price->discount_price > 0)
                                            <span class="old-price">${{ $product->price->selling_price }}</span>
                                            <span>
                                                @php
                                                    $finalPrice = $product->price->selling_price - $product->price->discount_price;
                                                @endphp
                                                {{ $finalPrice }}Ks
                                            </span>
                                        @else
                                            <span>{{ $product->price->selling_price }}Ks</span>
                                        @endif
                                    </div>

                                    <div class="d-flex justify-content-center mt-2">
                                        <a href="{{ url('product/details/'.$product->id.'/'.$product->product_slug) }}" class="btn btn-primary text-center w-100 custom-button hover-up">
                                            View Detail
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
                                                <a href="{{ url('product/details/'.$product->id.'/'.$product->product_slug) }}">
                                                    <img class="default-img" src="{{ !empty($product->product_photo) ? url('upload/product_images/' . $product->product_photo) : url('frontend/8ray/imgs/shop/product-1-2.jpg') }}" alt="" />

                                                    @php
                                                        $multiImage = $product->multiImages->first();
                                                    @endphp
                                                    <img class="hover-img" src="{{ !empty($multiImage) ? url('upload/product_multi_images/' . $multiImage->photo_name) : url('frontend/8ray/imgs/shop/product-1-2.jpg') }}" alt="" />
                                                </a>
                                            </div>
                                            <div class="product-action-1" id="product-action-1">
                                                <a aria-label="Quick view" class="action-btn small hover-up" data-bs-toggle="modal" data-bs-target="#quickViewModal" id="{{ $product->id }}" onclick="productView(this.id)"> <i class="fi-rs-eye"></i></a>
                                                <a aria-label="Add To Wishlist" class="action-btn" id="{{ $product->id }}" onclick="addToWishList(this.id)"  >
                                                    <i class="fi-rs-heart"></i>
                                                </a>
                                                <a aria-label="Compare" class="action-btn"  id="{{ $product->id }}" onclick="addToCompare(this.id)">
                                                    <i class="fi-rs-shuffle"></i>
                                                </a>
                                            </div>
                                            <div class="product-badges product-badges-position product-badges-mrg">
                                                @if ($product->productInfo)
                                                    @if ($product->productInfo->new)
                                                        <span class="new">New</span>
                                                    @elseif ($product->productInfo->hot)
                                                        <span class="hot">Hot</span>
                                                    @elseif ($product->productInfo->sale)
                                                        <span class="sale">Sale</span>
                                                    @elseif ($product->productInfo->best_sale)
                                                        <span class="best">Best Sale</span>
                                                    @endif
                                                @endif
                                            </div>
                                        </div>
                                        <div class="product-content-wrap">
                                            <div class="product-category">
                                                @foreach ($product->brands as $brand)
                                                <a href="{{ url('product/brandzone/'.$brand->id.'/'.$brand->brand_slug) }}">
                                                    {{ Str::limit($brand->brand_name, 25) }}
                                                </a>
                                                @endforeach
                                            </div>
                                            <h2><a href="{{ url('product/details/'.$product->id.'/'.$product->product_slug) }}">{{ Str::limit($product->product_name, 15) }}</a></h2>

                                            <div class="product-price">
                                                @if (!empty($product->price->discount_price) && $product->price->discount_price > 0)
                                                    <span class="old-price">${{ $product->price->selling_price }}</span>
                                                    <span>
                                                        @php
                                                            $finalPrice = $product->price->selling_price - $product->price->discount_price;
                                                        @endphp
                                                        {{ $finalPrice }}Ks
                                                    </span>
                                                @else
                                                    <span>{{ $product->price->selling_price }}Ks</span>
                                                @endif
                                            </div>
                                            <div class="d-flex justify-content-cente mt-2">
                                                <a href="{{ url('product/details/'.$product->id.'/'.$product->product_slug) }}" class="btn btn-primary text-center w-100 custom-button hover-up">
                                                    View Detail
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
                                                <a href="{{ url('product/details/'.$product->id.'/'.$product->product_slug) }}">
                                                    <img class="default-img" src="{{ !empty($product->product_photo) ? url('upload/product_images/' . $product->product_photo) : url('frontend/8ray/imgs/shop/product-1-2.jpg') }}" alt="" />

                                                    @php
                                                        $multiImage = $product->multiImages->first();
                                                    @endphp
                                                    <img class="hover-img" src="{{ !empty($multiImage) ? url('upload/product_multi_images/' . $multiImage->photo_name) : url('frontend/8ray/imgs/shop/product-1-2.jpg') }}" alt="" />
                                                </a>
                                            </div>
                                            <div class="product-action-1" id="product-action-1">
                                                <a aria-label="Quick view" class="action-btn small hover-up" data-bs-toggle="modal" data-bs-target="#quickViewModal" id="{{ $product->id }}" onclick="productView(this.id)"> <i class="fi-rs-eye"></i></a>
                                                <a aria-label="Add To Wishlist" class="action-btn" id="{{ $product->id }}" onclick="addToWishList(this.id)"  >
                                                    <i class="fi-rs-heart"></i>
                                                </a>
                                                <a aria-label="Compare" class="action-btn"  id="{{ $product->id }}" onclick="addToCompare(this.id)">
                                                    <i class="fi-rs-shuffle"></i>
                                                </a>
                                            </div>
                                            <div class="product-badges product-badges-position product-badges-mrg">
                                                @if ($product->productInfo)
                                                    @if ($product->productInfo->new)
                                                        <span class="new">New</span>
                                                    @elseif ($product->productInfo->hot)
                                                        <span class="hot">Hot</span>
                                                    @elseif ($product->productInfo->sale)
                                                        <span class="sale">Sale</span>
                                                    @elseif ($product->productInfo->best_sale)
                                                        <span class="best">Best Sale</span>
                                                    @endif
                                                @endif
                                            </div>
                                        </div>
                                        <div class="product-content-wrap">
                                            <div class="product-category">
                                                @foreach ($product->brands as $brand)
                                                    <a href="{{ url('product/brandzone/'.$brand->id.'/'.$brand->brand_slug) }}">
                                                        {{ Str::limit($brand->brand_name, 25) }}
                                                    </a>
                                                @endforeach
                                            </div>
                                            <h2><a href="{{ url('product/details/'.$product->id.'/'.$product->product_slug) }}">{{ Str::limit($product->product_name, 15) }}</a></h2>

                                            <div class="product-price">
                                                @if (!empty($product->price->discount_price) && $product->price->discount_price > 0)
                                                    <span class="old-price">${{ $product->price->selling_price }}</span>
                                                    <span>
                                                        @php
                                                            $finalPrice = $product->price->selling_price - $product->price->discount_price;
                                                        @endphp
                                                        {{ $finalPrice }}Ks
                                                    </span>
                                                @else
                                                    <span>{{ $product->price->selling_price }}Ks</span>
                                                @endif
                                            </div>
                                            <div class="d-flex justify-content-cente mt-2">
                                                <a href="{{ url('product/details/'.$product->id.'/'.$product->product_slug) }}" class="btn btn-primary text-center w-100 custom-button hover-up">
                                                    View Detail
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
                                        <a href="{{ url('product/details/'.$product->id.'/'.$product->product_slug) }}">
                                            <img class="default-img" src="{{ !empty($product->product_photo) ? url('upload/product_images/' . $product->product_photo) : url('frontend/8ray/imgs/shop/product-1-2.jpg') }}" alt="" />

                                            @php
                                                $multiImage = $product->multiImages->first();
                                            @endphp
                                            <img class="hover-img" src="{{ !empty($multiImage) ? url('upload/product_multi_images/' . $multiImage->photo_name) : url('frontend/8ray/imgs/shop/product-1-2.jpg') }}" alt="" />
                                        </a>
                                    </div>
                                    <div class="product-action-1" id="product-action-1">
                                        <a aria-label="Quick view" class="action-btn small hover-up" data-bs-toggle="modal" data-bs-target="#quickViewModal" id="{{ $product->id }}" onclick="productView(this.id)"> <i class="fi-rs-eye"></i></a>
                                        <a aria-label="Add To Wishlist" class="action-btn" id="{{ $product->id }}" onclick="addToWishList(this.id)"  >
                                            <i class="fi-rs-heart"></i>
                                        </a>
                                        <a aria-label="Compare" class="action-btn"  id="{{ $product->id }}" onclick="addToCompare(this.id)">
                                            <i class="fi-rs-shuffle"></i>
                                        </a>
                                    </div>
                                    <div class="product-badges product-badges-position product-badges-mrg">
                                        @if ($product->productInfo)
                                            @if ($product->productInfo->new)
                                                <span class="new">New</span>
                                            @elseif ($product->productInfo->hot)
                                                <span class="hot">Hot</span>
                                            @elseif ($product->productInfo->sale)
                                                <span class="sale">Sale</span>
                                            @elseif ($product->productInfo->best_sale)
                                                <span class="best">Best Sale</span>
                                            @endif
                                        @endif
                                    </div>
                                </div>
                                <div class="product-content-wrap">
                                    <div class="product-category">
                                        @foreach ($product->brands as $brand)
                                        <a href="{{ url('product/brandzone/'.$brand->id.'/'.$brand->brand_slug) }}">
                                            {{ Str::limit($brand->brand_name, 25) }}
                                        </a>
                                        @endforeach
                                    </div>
                                    <h2><a href="{{ url('product/details/'.$product->id.'/'.$product->product_slug) }}">{{ Str::limit($product->product_name, 15) }}</a></h2>

                                    <div class="product-price">
                                        @if (!empty($product->price->discount_price) && $product->price->discount_price > 0)
                                            <span class="old-price">${{ $product->price->selling_price }}</span>
                                            <span>
                                                @php
                                                    $finalPrice = $product->price->selling_price - $product->price->discount_price;
                                                @endphp
                                                {{ $finalPrice }}Ks
                                            </span>
                                        @else
                                            <span>{{ $product->price->selling_price }}Ks</span>
                                        @endif
                                    </div>
                                    <div class="d-flex justify-content-cente mt-2">
                                        <a href="{{ url('product/details/'.$product->id.'/'.$product->product_slug) }}" class="btn btn-primary text-center w-100 custom-button hover-up">
                                            View Detail
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
                            <a href="{{ url('product/brandzone/'.$brand->id.'/'.$brand->brand_slug) }}">
                                <img src="{{ !empty($brand->brand_image) ? url('upload/brand_images/' . $brand->brand_image) : url('upload/profile.jpg') }}"
                                alt="{{ $brand->brand_name }}">
                            </a>
                        </figure>
                        <h6>
                            <a href="{{ url('product/brandzone/'.$brand->id.'/'.$brand->brand_slug) }}">
                                {{ $brand->brand_name }}
                            </a>
                        </h6>
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
