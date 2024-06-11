<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Product;
use App\Models\ProductCategory;
use App\Models\ProductSubCategory;
use App\Models\ProductType;
use App\Models\ProductColor;
use App\Models\ProductInfo;
use App\Models\MultiImg;
use App\Models\Brand;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Validator;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;


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
        //dd($request->all());
        $validator = Validator::make($request->all(), [
            'product_code' => 'required|string|max:255',
            'product_name' => 'required|string|max:255',
            //'brand_id' => 'required|string|max:255',
            //'product_color_id' => 'required|string|max:255',
            'product_category_id' => 'required|string|max:255',
            'product_subcategory_id' => 'required|string|max:255',
        ]);

        if ($validator->fails()) {
            $notification = [
                'message' => 'Validation failed.',
                'alert-type' => 'error',
            ];
            return redirect()->back()->withErrors($validator)->withInput()->with($notification);
        }

        $validatedData = $validator->validated();

        // Create the product
        $product = new Product();
        $product->product_code = $request->input('product_code');
        $product->product_name = $request->input('product_name');
        $product->product_slug = Str::slug($request->input('product_name'));
        $product->status = $request->input('status', 'active');
        $product->user_id = auth()->id();
        $product->save();

        // Create Product Color

        /*
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
        $product->productColor()->attach($colorIds);

         // Create Product Brand
        $brands = explode(',', $validatedData['brand_id']);
        $brandIds = [];
        foreach ($brands as $brand_name) {
            $brand_name = trim($brand_name);
            $brand = Brand::firstOrCreate(
                ['brand_name' => $brand_name],
                ['brand_slug' => Str::slug($brand_name)]
            );
            $brandIds[] = $brand->id;
        }
        $product->brands()->attach($brandIds);

        */


        $product_categories = explode(',', $validatedData['product_category_id']);
        $categoryIds = [];
        foreach ($product_categories as $category) {
            $category = trim($category);
            $productCategory = ProductCategory::firstOrCreate(
                ['product_category_name' => $category],
                ['product_category_slug' => Str::slug($category)]
            );
            $categoryIds[] = $productCategory->id;
        }
        $product->productCategory()->attach($categoryIds);


        if (!empty($validatedData['product_subcategory_id'])) {
            $subcategoryNames = explode(',', $validatedData['product_subcategory_id']);
            foreach ($subcategoryNames as $categoryName) {
                $subcategory = ProductSubCategory::firstOrCreate(['product_subcategory_name' => trim($categoryName)]);
                $subcategory->product_categories_id = 1;
                $subcategory->product_subcategory_slug = Str::slug($subcategory->product_subcategory_name);
                $subcategory->save();
                $product->productSubCategory()->attach($subcategory->id);
            }
        }


        $notification = [
            'message' => 'Product created successfully!',
            'alert-type' => 'success',
        ];

        return redirect()->route('all.product')->with($notification);
    }
}
