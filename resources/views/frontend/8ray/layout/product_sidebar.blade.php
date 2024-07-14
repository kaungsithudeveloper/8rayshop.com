
<div class="col-xl-3 primary-sidebar sticky-sidebar mt-30">

    @php
        $categories = App\Models\ProductCategory::where('id', '!=', 1)
            ->withCount(['products as active_products_count' => function ($query) {
                $query->where('status', 'active');
            }])
            ->get();
    @endphp

    <div class="sidebar-widget widget-category-2 mb-30">
        <h5 class="section-title style-1 mb-30">Category</h5>
        <ul>
            @foreach($categories as $category)
                <li>
                    <a href="{{ url('product/category/'.$category->id.'/'.$category->product_category_slug) }}">
                        <img src="{{ !empty($category->product_category_image) ? url('upload/product_category_images/' . $category->product_category_image) : url('frontend/8ray/imgs/shop/product-1-2.jpg') }}" alt="" />
                        {{ $category->product_category_name }}
                    </a><span class="count">{{ $category->active_products_count }}</span>
                </li>
            @endforeach
        </ul>
    </div>

    @php
         use Illuminate\Support\Str;
        $productTypeId = 1; // Replace with the desired product_type_id
         $newProducts = App\Models\Product::where('status','active')->where('product_type_id', $productTypeId)->orderBy('updated_at', 'desc')
                        ->take(6)->get();
    @endphp


    <!-- Product sidebar Widget -->
    @if($newProducts)
    <div class="sidebar-widget product-sidebar mb-30 p-30 bg-grey border-radius-10">
        <h5 class="section-title style-1 mb-30">New products</h5>
        @foreach ($newProducts as $product)
            <div class="single-post clearfix">
                <div class="image">
                    <img src="{{ !empty($product->product_photo) ? url('upload/product_images/' . $product->product_photo) : url('frontend/8ray/imgs/shop/product-1-2.jpg') }}" alt="#" />
                </div>


                <div class="product-content-wrap">
                    <h6><a href="shop-product-right.html" tabindex="0">{{ Str::limit($product->product_name, 45) }}</a></h6>
                </div>
            </div>
        @endforeach
    </div>
    @else
        <p>No related product found.</p>
    @endif
</div>
