@php
    $productTypeId = 1;
    $related_products = App\Models\Product::with('multiImages')
                                         ->where('status', 'active')
                                         ->where('product_type_id', $productTypeId)
                                         ->limit(4)
                                         ->get();
@endphp

@if($related_products->isNotEmpty())
<div class="col-12">
    <div class="row related-products">
        @foreach($related_products as $related_product)
        <div class="col-lg-3 col-md-4 col-6 col-sm-6">
            <div class="product-cart-wrap hover-up">
                <div class="product-img-action-wrap">
                    <div class="product-img product-img-zoom">
                        <a href="{{ url('product/details/'.$related_product->id.'/'.$related_product->product_slug) }}">
                            <img class="default-img" src="{{ !empty($related_product->product_photo) ? url('upload/product_images/' . $related_product->product_photo) : url('frontend/8ray/imgs/shop/product-1-2.jpg') }}" alt="" />
                        </a>
                    </div>
                    <div class="product-action-1" id="product-action-1">
                        <a aria-label="Quick view" class="action-btn small hover-up" data-bs-toggle="modal" data-bs-target="#quickViewModal" id="{{ $related_product->id }}" onclick="productView(this.id)"> <i class="fi-rs-eye"></i></a>
                        <a aria-label="Add To Wishlist" class="action-btn" id="{{ $related_product->id }}" onclick="addToWishList(this.id)">
                            <i class="fi-rs-heart"></i>
                        </a>
                        <a aria-label="Compare" class="action-btn" id="{{ $related_product->id }}" onclick="addToCompare(this.id)">
                            <i class="fi-rs-shuffle"></i>
                        </a>
                    </div>
                    <div class="product-badges product-badges-position product-badges-mrg">
                        @if ($related_product->productInfo)
                            @if ($related_product->productInfo->new)
                                <span class="new">New</span>
                            @elseif ($related_product->productInfo->hot)
                                <span class="hot">Hot</span>
                            @elseif ($related_product->productInfo->sale)
                                <span class="sale">Sale</span>
                            @elseif ($related_product->productInfo->best_sale)
                                <span class="best">Best Sale</span>
                            @endif
                        @endif
                    </div>
                </div>
                <div class="product-content-wrap">
                    <h2><a href="shop-product-right.html" tabindex="0">{{ $related_product->product_name }}</a></h2>
                    <div class="product-price">
                        @if (!empty($related_product->price->discount_price))
                            <span class="old-price">${{ $related_product->price->selling_price }}</span>
                            <span>{{ $related_product->price->discount_price }}Ks</span>
                        @else
                            <span>{{ $related_product->price->selling_price }}Ks</span>
                        @endif
                    </div>
                </div>
            </div>
        </div>
        @endforeach
    </div>
</div>
@else
    <p>No related products found.</p>
@endif
