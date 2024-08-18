@extends('frontend.8ray.layout.layout')

@section('8ray')

<main class="main pages">

    <div class="page-header breadcrumb-wrap">
        <div class="container">
            <div class="breadcrumb">
                <a href="{{ route('8ray.frontend') }}" rel="nofollow"><i class="fi-rs-home mr-5"></i>Home</a>
                <span></span> <a href="{{ url('product/category/'.$breadcat->id.'/'.$breadcat->product_category_slug) }}" rel="nofollow">
                    {{ $breadcat->product_category_name }}
                </a>
            </div>
        </div>
    </div>


    <div class="container mb-30">
        <div class="row">
            <div class="col-xl-11 col-lg-12 m-auto">
                <div class="row flex-row-reverse">

                    <div class="col-xl-9 mt-30">
                        <div class="row product-grid">

                            @foreach ($categoryProducts as $product)
                                <div class="col-lg-3 col-md-3 col-6 col-sm-6">
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
                                                @foreach ($product->brands as $category)
                                                    <a href="shop-grid-right.html">{{ $category->brand_name }}</a>
                                                @endforeach
                                            </div>
                                            <h2><a href="{{ url('product/details/'.$product->id.'/'.$product->product_slug) }}">{{ $product->product_name }}</a></h2>
                                            <div class="product-rate d-inline-block">
                                                <div class="product-rating" style="width: 80%"></div>
                                            </div>
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

                        </div>
                        <!--product grid-->
                        <!-- Pagination Area -->
                        <div class="pagination-area mt-20 mb-20">
                            <nav aria-label="Page navigation example">
                                <ul class="pagination justify-content-center">
                                    <!-- Previous Page Link -->
                                    @if ($categoryProducts->onFirstPage())
                                        <li class="page-item disabled">
                                            <span class="page-link"><i class="fi-rs-arrow-small-left"></i></span>
                                        </li>
                                    @else
                                        <li class="page-item">
                                            <a class="page-link" href="{{ $categoryProducts->previousPageUrl() }}" rel="prev"><i class="fi-rs-arrow-small-left"></i></a>
                                        </li>
                                    @endif

                                    <!-- First Page -->
                                    @if ($categoryProducts->currentPage() > 2)
                                        <li class="page-item"><a class="page-link" href="{{ $categoryProducts->url(1) }}">1</a></li>
                                        @if ($categoryProducts->currentPage() > 3)
                                            <li class="page-item"><span class="page-link dot">...</span></li>
                                        @endif
                                    @endif

                                    <!-- Pages around the Current Page -->
                                    @for ($i = max(1, $categoryProducts->currentPage() - 1); $i <= min($categoryProducts->lastPage(), $categoryProducts->currentPage() + 1); $i++)
                                        @if ($i == $categoryProducts->currentPage())
                                            <li class="page-item active"><span class="page-link">{{ $i }}</span></li>
                                        @else
                                            <li class="page-item"><a class="page-link" href="{{ $categoryProducts->url($i) }}">{{ $i }}</a></li>
                                        @endif
                                    @endfor

                                    <!-- Last Page -->
                                    @if ($categoryProducts->currentPage() < $categoryProducts->lastPage() - 1)
                                        @if ($categoryProducts->currentPage() < $categoryProducts->lastPage() - 2)
                                            <li class="page-item"><span class="page-link dot">...</span></li>
                                        @endif
                                        <li class="page-item"><a class="page-link" href="{{ $categoryProducts->url($categoryProducts->lastPage()) }}">{{ $categoryProducts->lastPage() }}</a></li>
                                    @endif

                                    <!-- Next Page Link -->
                                    @if ($categoryProducts->hasMorePages())
                                        <li class="page-item">
                                            <a class="page-link" href="{{ $categoryProducts->nextPageUrl() }}" rel="next"><i class="fi-rs-arrow-small-right"></i></a>
                                        </li>
                                    @else
                                        <li class="page-item disabled">
                                            <span class="page-link"><i class="fi-rs-arrow-small-right"></i></span>
                                        </li>
                                    @endif
                                </ul>
                            </nav>
                        </div>


                        <div class="row mt-60">
                            <div class="col-12">
                                <h2 class="section-title style-1 mb-30">Related products</h2>
                            </div>
                                @include('frontend.8ray.layout.related_product')
                        </div>
                        <!--End Deals-->
                    </div>

                    @include('frontend.8ray.layout.product_sidebar')

                </div>
            </div>
        </div>
    </div>


</main>

@endsection
