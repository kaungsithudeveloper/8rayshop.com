@extends('frontend.8ray.layout.layout')

@section('8ray')

<main class="main pages">
    <div class="page-header breadcrumb-wrap">
        <div class="container">
            <div class="breadcrumb">
                <a href="{{ route('8ray.frontend') }}" rel="nofollow"><i class="fi-rs-home mr-5"></i>Home</a>
                <span></span> Pages <span></span> Login
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
                                    <a href="shop-product-right.html">
                                        <img class="default-img" src="{{ !empty($brand->brand_image) ? url('upload/brand_images/' . $brand->brand_image) : url('upload/profile.jpg') }}" alt="" />
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endforeach
                    <!--end product card-->
                </div>

                <!--product grid-->
                <div class="pagination-area mt-20 mb-20">
                    <nav aria-label="Page navigation example">
                        <ul class="pagination justify-content-center">
                            <li class="page-item">
                                <a class="page-link" href="#"><i class="fi-rs-arrow-small-left"></i></a>
                            </li>
                            <li class="page-item"><a class="page-link" href="#">1</a></li>
                            <li class="page-item active"><a class="page-link" href="#">2</a></li>
                            <li class="page-item"><a class="page-link" href="#">3</a></li>
                            <li class="page-item"><a class="page-link dot" href="#">...</a></li>
                            <li class="page-item"><a class="page-link" href="#">6</a></li>
                            <li class="page-item">
                                <a class="page-link" href="#"><i class="fi-rs-arrow-small-right"></i></a>
                            </li>
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
