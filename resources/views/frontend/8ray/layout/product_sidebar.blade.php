

<div class="col-xl-3 primary-sidebar sticky-sidebar mt-30">

    @php
        $categories = App\Models\ProductCategory::where('id', '!=', 1)->withCount('products')->get();
    @endphp

    <div class="sidebar-widget widget-category-2 mb-30">
        <h5 class="section-title style-1 mb-30">Category</h5>
        <ul>
            @foreach($categories as $category)
                <li>
                    <a href="shop-grid-right.html">
                        <img src="{{ !empty($category->product_category_image) ? url('upload/product_category_images/' . $category->product_category_image) : url('frontend/8ray/imgs/shop/product-1-2.jpg') }}" alt="" />
                            {{ $category->product_category_name }}
                    </a><span class="count">{{ $category->products_count }}</span>
                </li>
            @endforeach
        </ul>
    </div>

    @php
        $newProducts = App\Models\Product::orderBy('updated_at', 'desc')->take(6)->get();
    @endphp

    <!-- Product sidebar Widget -->
    <div class="sidebar-widget product-sidebar mb-30 p-30 bg-grey border-radius-10">
        <h5 class="section-title style-1 mb-30">New products</h5>
        @foreach ($newProducts as $product)
            <div class="single-post clearfix">
                <div class="image">
                    <img src="{{ !empty($product->product_photo) ? url('upload/product_images/' . $product->product_photo) : url('frontend/8ray/imgs/shop/product-1-2.jpg') }}" alt="#" />
                </div>
                <div class="content pt-10">
                    <h5><a href="shop-product-detail.html">{{ $product->product_name }}</a></h5>
                    <div class="product-price">
                        @if (!empty($product->price->discount_price))
                            <span class="old-price">${{ $product->price->selling_price }}</span>
                            <span>{{ $product->price->discount_price }}Ks</span>
                        @else
                            <span>{{ $product->price->selling_price }}Ks</span>
                        @endif
                    </div>
                </div>
            </div>
        @endforeach
    </div>
</div>
