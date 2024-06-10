<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Product;
use App\Models\ProductCategory;
use App\Models\ProductSubCategory;
use App\Models\ProductType;
use App\Models\ProductInfo;
use App\Models\MultiImg;
use App\Models\Brand;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Validator;
use Carbon\Carbon;


class ProductController extends Controller
{
    public function AllProduct(){
        $products = Product::latest()->get();
        return view('backend.admin.product.product_all',compact('products'));
    } // End Method

    public function AddProduct(){

        $product_type = ProductType::orderBy('product_type_name','ASC')->get();
        $brands = Brand::orderBy('brand_name','ASC')->get();
        $product_categories = ProductCategory::orderBy('product_category_name','ASC')->get();
        $product_sub_categories = ProductSubCategory::orderBy('product_subcategory_name','ASC')->get();
        return view('backend.admin.product.product_add',compact('product_type','brands','product_categories','product_sub_categories'));

    } // End Method

    public function StoreProduct(Request $request)
    {
        // Validate the request data
        $validator = Validator::make($request->all(), [
            'product_code' => 'required|string|max:255',
            'product_name' => 'required|string|max:255',
            'brand_id' => 'required|string|max:255',
            'product_color_id' => 'required|string|max:255',
        ]);

        if ($validator->fails()) {
            $notification = [
                'message' => 'Validation Error: ' . implode(', ', $validator->errors()->all()),
                'alert-type' => 'error',
            ];

            return redirect()->back()->with($notification);
        }

        $validatedData = $validator->validated();

        // Create new product
        $product = new Product();
        $product->product_code = $validatedData['product_code'];
        $product->product_name = $validatedData['product_name'];
        $product->product_slug = Str::slug($validatedData['product_name']);
        $product->user_id = auth()->user()->id;
        $product->status = 'inactive';
        $product->save();

        // Create and associate product colors
        $product_colors = explode(',', $validatedData['product_color_id']);
        $colorIds = [];
        foreach ($product_colors as $color_name) {
            $color_name = trim($color_name);
            $productColor = ProductColor::firstOrCreate(
                ['color_name' => $color_name],
                ['color_slug' => Str::slug($color_name)]
            );
            $colorIds[] = $productColor->id;
        }

        // Attach colors to product through product_info_belong
        $product->productColors()->attach($colorIds);

        // Create and associate brands
        $brands = explode(',', $validatedData['brand_id']);
        $brandIds = [];
        foreach ($brands as $brand) {
            $brand = trim($brand);
            $brand = Brand::firstOrCreate(
                ['brand_name' => $brand],
                ['brand_slug' => Str::slug($brand)]
            );
            $brandIds[] = $brand->id;
        }

        // Attach brands to product through product_info_belong
        $product->brands()->attach($brandIds);

        $notification = [
            'message' => 'Product created successfully!',
            'alert-type' => 'success',
        ];

        return redirect()->route('all.product')->with($notification);
    }
}
