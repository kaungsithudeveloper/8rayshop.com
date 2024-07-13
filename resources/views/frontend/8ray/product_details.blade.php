@extends('frontend.8ray.layout.layout')

@section('8ray')

<main class="main pages">
    <div class="page-header breadcrumb-wrap">
        <div class="container">
            <div class="breadcrumb">
                <a href="{{ route('8ray.frontend') }}" rel="nofollow"><i class="fi-rs-home mr-5"></i>Home</a>
                <span></span>
                    @foreach($product->categories as $category)
                        {{ $category->product_category_name }}{{ !$loop->last ? ', ' : '' }}
                    @endforeach
                <span></span> {{ $product->product_name }}
            </div>
        </div>
    </div>

    <div class="container mb-30">
        <div class="row">
            <div class="col-xl-11 col-lg-12 m-auto">
                <div class="row flex-row-reverse">

                    <div class="col-xl-9">
                        <div class="product-detail accordion-detail">
                            <div class="row mb-50 mt-30">
                                <div class="col-md-6 col-sm-12 col-xs-12 mb-md-0 mb-sm-5">
                                    <div class="detail-gallery">
                                        <!-- MAIN SLIDES -->
                                        <div class="product-image-slider">
                                            @if($product->product_photo)
                                                <figure class="border-radius-10">
                                                    <img src="{{ !empty($product->product_photo) ? url('upload/product_images/' . $product->product_photo) : url('frontend/8ray/imgs/shop/product-1-2.jpg') }}" alt="product image" />
                                                </figure>

                                                @foreach($product->multiImages as $multiImage)
                                                    <figure class="border-radius-10">
                                                        <img src="{{ !empty($multiImage->photo_name) ? url('upload/product_multi_images/' . $multiImage->photo_name) : url('frontend/8ray/imgs/shop/product-1-2.jpg') }}" alt="product image" />
                                                    </figure>
                                                @endforeach
                                            @endif
                                        </div>
                                        <!-- THUMBNAILS -->
                                        <div class="slider-nav-thumbnails">
                                            @if($product->product_photo)
                                                <div>
                                                    <img src="{{ !empty($product->product_photo) ? url('upload/product_images/' . $product->product_photo) : url('frontend/8ray/imgs/shop/product-1-2.jpg') }}" alt="product image" />
                                                </div>
                                                @foreach($product->multiImages as $multiImage)
                                                <div>
                                                    <img src="{{ !empty($multiImage) ? url('upload/product_multi_images/' . $multiImage->photo_name) : url('frontend/8ray/imgs/shop/product-1-2.jpg') }}" alt="product image" />
                                                </div>
                                                @endforeach
                                            @endif
                                        </div>
                                    </div>
                                    <!-- End Gallery -->
                                </div>
                                <div class="col-md-6 col-sm-12 col-xs-12">
                                    <div class="detail-info pr-30 pl-30">
                                        @if($product->total_stock > 0)
                                            <span class="stock-status in-stock">In Stock </span>
                                        @else
                                            <span class="stock-status out-stock">Out Of Stock </span>
                                        @endif
                                        <h2 class="title-detail" id="dpname"> {{ $product->product_name }} </h2>

                                        <div class="clearfix product-price-cover">
                                            <div class="product-price primary-color float-left">
                                                @if($product->price)
                                                    @if($product->price->discount_price && $product->price->discount_price > 0)
                                                        <!-- Show discount price and old price -->
                                                        <span class="current-price text-brand">
                                                            @php
                                                                $finalPrice = $product->price->selling_price - $product->price->discount_price;
                                                            @endphp
                                                            {{ $finalPrice }}Ks
                                                        </span>
                                                        <span>
                                                            <span class="save-price font-md color3 ml-15">
                                                                {{ round((($product->price->selling_price - $product->price->discount_price) / $product->price->selling_price) * 100) }}% Off
                                                            </span>
                                                            <span class="old-price font-md ml-15">
                                                                {{ $product->price->selling_price }}Ks
                                                            </span>
                                                        </span>
                                                    @else
                                                        <!-- Show only the selling price -->
                                                        <span class="current-price text-brand">
                                                            {{ $product->price->selling_price }}Ks
                                                        </span>
                                                    @endif
                                                @endif
                                            </div>
                                        </div>

                                        <div class="short-desc mb-30">
                                            <p class="font-lg">{{ $product->productInfo->short_descp }}</p>
                                        </div>

                                        <div class="attr-detail attr-size mb-30">
                                            <strong class="mr-10" style="width:60px;">Color :</strong>
                                            <select class="form-control unicase-form-control" id="dcolor">
                                                    @foreach($product->productColor as $color)
                                                        <option value="{{ $color->id }}">{{ $color->color_name }}</option>
                                                    @endforeach

                                            </select>
                                        </div>

                                        <div class="detail-extralink mb-50">
                                            <div class="detail-qty border radius">
                                                <a href="#" class="qty-down"><i class="fi-rs-angle-small-down"></i></a>
                                                <input type="text" name="quantity" id="dqty" class="qty-val" value="1" min="1">
                                                <a href="#" class="qty-up"><i class="fi-rs-angle-small-up"></i></a>
                                            </div>
                                            <div class="product-extra-link2">
                                                <input type="hidden" id="dproduct_id" value="{{ $product->id }}">
                                                <button type="submit" class="button button-add-to-cart" onclick="addToCartDetails()">
                                                    <i class="fi-rs-shopping-cart"></i>Add to cart
                                                </button>
                                                <a aria-label="Add To Wishlist" class="action-btn" id="{{ $product->id }}" onclick="addToWishList(this.id)"  >
                                                    <i class="fi-rs-heart"></i>
                                                </a>
                                                <a aria-label="Compare" class="action-btn hover-up" href="shop-compare.html"><i class="fi-rs-shuffle"></i></a>
                                            </div>
                                        </div>
                                        <div class="font-xs">
                                            <ul class="mr-50 float-start">
                                                <li class="mb-5">Brand:
                                                    @foreach($product->brands as $brand)
                                                        <a class="" href=""> {{ $brand->brand_name }}</a>
                                                    @endforeach
                                                </li>
                                                <li class="mb-5">Subcategories:
                                                    @foreach($product->categories as $category)
                                                        <a class="" href=""> {{ $category->product_category_name }} </a>
                                                    @endforeach
                                                </li>
                                            </ul>
                                            <ul class="float-start">
                                                <li class="mb-5">Product Code: <a href="#">{{ $product->product_code }}</a></li>
                                                <li>Stock:
                                                    <span class="in-stock text-brand ml-5">({{ $product->total_stock }}) Items In Stock</span>
                                                </li>


                                            </ul>
                                        </div>
                                    </div>
                                    <!-- Detail Info -->
                                </div>
                            </div>
                            <div class="product-info">
                                <div class="tab-style3">
                                    <ul class="nav nav-tabs text-uppercase">
                                        <li class="nav-item">
                                            <a class="nav-link active" id="Description-tab" data-bs-toggle="tab" href="#Description">Description</a>
                                        </li>

                                        <li class="nav-item">
                                            <a class="nav-link" id="Reviews-tab" data-bs-toggle="tab" href="#Reviews">Reviews ({{ $commentCount }})</a>
                                        </li>
                                    </ul>
                                    <div class="tab-content shop_info_tab entry-main-content">
                                        <div class="tab-pane fade show active" id="Description">
                                            <div class="">

                                                {!! html_entity_decode($product->productInfo->long_descp) !!}
                                            </div>
                                        </div>



                                        <div class="tab-pane fade" id="Reviews">
                                            <div class="comments-area">
                                                <div class="row">
                                                    <div class="col-lg-8">
                                                        <h4 class="mb-20">Customer questions & answers</h4>
                                                        <div class="comment-list">
                                                            @foreach($product->comments as $comment)
                                                                <div class="single-comment justify-content-between d-flex mb-30">
                                                                    <div class="user justify-content-between d-flex">
                                                                        <div class="thumb text-center">
                                                                            <img src="{{ !empty($comment->user->photo) ? url('upload/user_images/' . $comment->user->photo) : url('upload/profile.jpg') }}" alt="" />
                                                                            <a href="#" class="font-heading text-brand">{{ $comment->user->name }}</a>
                                                                        </div>
                                                                        <div class="desc">
                                                                            <div class="d-flex justify-content-between mb-10">
                                                                                <div class="d-flex align-items-center">
                                                                                    <span class="font-xs text-muted">
                                                                                        {{ $comment->created_at->format('F d, Y \a\t h:i a') }}
                                                                                    </span>
                                                                                </div>
                                                                            </div>
                                                                            <p class="mb-10">
                                                                                {{ $comment->content }}
                                                                                <a href="#" class="reply" onclick="showReplyForm({{ $comment->id }}); return false;">Reply</a>
                                                                            </p>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div id="reply-form-{{ $comment->id }}" style="display: none;">
                                                                    <form action="{{ route('comments.reply', $comment) }}" method="POST">
                                                                        @csrf
                                                                        <div class="form-group">
                                                                            <textarea class="form-control w-100" name="content" cols="30" rows="2" placeholder="Write Reply"></textarea>
                                                                        </div>
                                                                        <div class="form-group">
                                                                            <button type="submit" class="button button-contactForm">Submit Reply</button>
                                                                        </div>
                                                                    </form>
                                                                </div>
                                                                @if($comment->replies)
                                                                    @foreach($comment->replies as $reply)
                                                                        <div class="single-comment justify-content-between d-flex mb-30 ml-30">
                                                                            <div class="user justify-content-between d-flex">
                                                                                <div class="thumb text-center">
                                                                                    <img src="{{ !empty($reply->user->photo) ? url('upload/user_images/' . $reply->user->photo) : url('upload/profile.jpg') }}" alt="" />
                                                                                    <a href="#" class="font-heading text-brand">
                                                                                        {{ $reply->user->name }}
                                                                                    </a>
                                                                                </div>
                                                                                <div class="desc">
                                                                                    <div class="d-flex justify-content-between mb-10">
                                                                                        <div class="d-flex align-items-center">
                                                                                            <span class="font-xs text-muted">
                                                                                                {{ $reply->created_at->format('F d, Y \a\t h:i a') }}
                                                                                            </span>
                                                                                        </div>
                                                                                    </div>
                                                                                    <p class="mb-10">
                                                                                        {{ $reply->content }}
                                                                                        <a href="#" class="reply" onclick="document.getElementById('reply-form-{{ $comment->id }}').style.display='block';">Reply</a>
                                                                                    </p>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    @endforeach
                                                                @endif
                                                            @endforeach
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <!--comment form-->
                                            <div class="comment-form">
                                                <h4 class="mb-15">Add a review</h4>
                                                @if (Auth::check())
                                                    <div class="row">
                                                        <div class="col-lg-8 col-md-12">
                                                            <form class="form-contact comment_form" action="{{ route('comments.store') }}" method="POST" id="commentForm">
                                                                @csrf
                                                                <input type="hidden" name="product_id" value="{{ $product->id }}">
                                                                <div class="row">
                                                                    <div class="col-12">
                                                                        <div class="form-group">
                                                                            <textarea class="form-control w-100" name="content" id="comment" cols="30" rows="9" placeholder="Write Comment"></textarea>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="form-group">
                                                                    <button type="submit" class="button button-contactForm">Submit Review</button>
                                                                </div>
                                                            </form>
                                                        </div>
                                                    </div>
                                                @else
                                                    <div class="alert alert-info">
                                                        You must be logged in to post a comment.
                                                    </div>
                                                    <a href="{{ route('8ray.login') }}" class="btn btn-primary">Log In</a>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row mt-60">
                                <div class="col-12">
                                    <h2 class="section-title style-1 mb-30">Related products</h2>
                                </div>
                                @include('frontend.8ray.layout.related_product')
                            </div>
                        </div>
                    </div>

                    @include('frontend.8ray.layout.product_sidebar')

                </div>
            </div>
        </div>
    </div>
    <script>
        function showReplyForm(commentId) {
            document.getElementById('reply-form-' + commentId).style.display = 'block';
        }
    </script>
</main>

@endsection
