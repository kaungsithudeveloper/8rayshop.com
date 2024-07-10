@extends('frontend.8ray.layout.layout')

@section('8ray')

<main class="main pages">
    <div class="page-header breadcrumb-wrap">
        <div class="container">
            <div class="breadcrumb">
                <a href="{{ route('8ray.frontend') }}" rel="nofollow"><i class="fi-rs-home mr-5"></i>Home</a>
                <span></span> <a href="{{ route('8ray.brandzone') }}" rel="nofollow">
                    Brands
                </a>
            </div>
        </div>
    </div>

    <div class="container mt-30 mb-30">
        <div class="row flex-row-reverse">
            <div class="col-xl-9">
                <div class="row product-grid">
                    @foreach ($brands as $key => $brand)
                    <div class="col-3 col-md-2 col-lg-2">
                        <div class="product-cart-wrap mb-30">
                            <div class="product-img-action-wrap">
                                <div class="product-img product-img-zoom">
                                    <a href="{{ route('8ray.brandzone.productList', ['id' => $product->id, 'slug' => $product->product_slug]) }}">
                                        <img class="default-img" src="{{ !empty($brand->brand_image) ? url('upload/brand_images/' . $brand->brand_image) : url('upload/profile.jpg') }}" alt="" />
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endforeach
                    <!--end product card-->
                </div>

                <!-- Pagination Area -->
                <div class="pagination-area mt-20 mb-20">
                    <nav aria-label="Page navigation example">
                        <ul class="pagination justify-content-center">
                            <!-- Previous Page Link -->
                            @if ($brands->onFirstPage())
                                <li class="page-item disabled">
                                    <span class="page-link"><i class="fi-rs-arrow-small-left"></i></span>
                                </li>
                            @else
                                <li class="page-item">
                                    <a class="page-link" href="{{ $brands->previousPageUrl() }}" rel="prev"><i class="fi-rs-arrow-small-left"></i></a>
                                </li>
                            @endif

                            <!-- First Page -->
                            @if ($brands->currentPage() > 2)
                                <li class="page-item"><a class="page-link" href="{{ $brands->url(1) }}">1</a></li>
                                @if ($brands->currentPage() > 3)
                                    <li class="page-item"><span class="page-link dot">...</span></li>
                                @endif
                            @endif

                            <!-- Pages around the current page -->
                            @for ($i = max(1, $brands->currentPage() - 1); $i <= min($brands->lastPage(), $brands->currentPage() + 1); $i++)
                                @if ($i == $brands->currentPage())
                                    <li class="page-item active"><span class="page-link">{{ $i }}</span></li>
                                @else
                                    <li class="page-item"><a class="page-link" href="{{ $brands->url($i) }}">{{ $i }}</a></li>
                                @endif
                            @endfor

                            <!-- Last Page -->
                            @if ($brands->currentPage() < $brands->lastPage() - 1)
                                @if ($brands->currentPage() < $brands->lastPage() - 2)
                                    <li class="page-item"><span class="page-link dot">...</span></li>
                                @endif
                                <li class="page-item"><a class="page-link" href="{{ $brands->url($brands->lastPage()) }}">{{ $brands->lastPage() }}</a></li>
                            @endif

                            <!-- Next Page Link -->
                            @if ($brands->hasMorePages())
                                <li class="page-item">
                                    <a class="page-link" href="{{ $brands->nextPageUrl() }}" rel="next"><i class="fi-rs-arrow-small-right"></i></a>
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

</main>

@endsection
