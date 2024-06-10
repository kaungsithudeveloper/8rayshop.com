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
use App\Models\ProductColor;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Validator;
use Carbon\Carbon;
use Database\Seeders\ProductSubCategorySeeder;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;


class ProductController extends Controller
{
    public function AllProduct(){
        $products = Product::latest()->get();
        return view('backend.admin.product.product_all',compact('products'));
    } // End Method

    public function AddProduct(){

        $product_type = ProductType::orderBy('product_type_name','ASC')->get();
        $brands = Brand::orderBy('brand_name','ASC')->get();
        $product_categories = ProductCategory::where('id', '!=', 1)->orderBy('product_category_name', 'ASC')->get();
        $product_sub_categories = ProductSubCategory::where('id', '!=', 1)->orderBy('product_subcategory_name','ASC')->get();
        return view('backend.admin.product.product_add',compact('product_type','brands','product_categories','product_sub_categories'));

    } // End Method



    public function StoreProduct(Request $request)
    {
        // Validate the request data
        //dd($request->all());
        $validator = Validator::make($request->all(), [
            'product_code' => 'required|string|max:255',
            'product_name' => 'required|string|max:255',
            'brand_id' => 'required|string|max:255',
            'product_color_id' => 'required|string|max:255',
            'product_category_id' => 'required|integer',
            'product_subcategory_id' => 'required|array',
            'product_subcategory_id.*' => 'integer',
        ]);

        if ($validator->fails()) {
            $notification = [
                'message' => 'Validation failed.',
                'alert-type' => 'error',
            ];
            return redirect()->back()->withErrors($validator)->withInput()->with($notification);
        }

        // Create the product
        $product = new Product();
        $product->product_code = $request->input('product_code');
        $product->product_name = $request->input('product_name');
        $product->product_slug = Str::slug($request->input('product_name'));
        $product->status = $request->input('status', 'active');
        $product->user_id = auth()->id();
        $product->save();

        // Handle product colors
        $product_colors = explode(',', $request->input('product_color_id'));
        foreach ($product_colors as $color_name) {
            $color_name = trim($color_name);
            $color = ProductColor::firstOrCreate(['color_name' => $color_name], ['color_slug' => Str::slug($color_name)]);
            $product->productColor()->attach($color->id);
        }

        // Handle product categories
        $product_category_names = explode(',', $request->input('prodct_category_id'));
        $product_categoryIds = [];
        foreach ($product_category_names as $category_name) {
            $category_name = trim($category_name);
            $category = ProductCategory::firstOrCreate(
                ['product_category_name' => $category_name],
                ['product_category_slug' => Str::slug($category_name)]
            );
            $product_categoryIds[] = $category->id;
        }
        $product->productCategory()->attach($product_categoryIds);

        // Handle product subcategories
        $product_subCategories = explode(',', $request->input('product_subcategory_id'));
        $product_subCategoryIds = [];
        foreach ($product_subCategories as $subCategory_name) {
            $subCategory_name = trim($subCategory_name);
            $subCategory = ProductSubCategory::firstOrCreate(
                ['product_category_id' => $product_categoryIds[0]], // Assuming the first category is used
                ['product_subcategory_name' => $subCategory_name, 'product_subcategory_slug' => Str::slug($subCategory_name)]
            );
            $product_subCategoryIds[] = $subCategory->id;
        }
        $product->productSubCategory()->attach($product_subCategoryIds);

        foreach ($product_subCategoryIds as $subcategoryId) {
            DB::table('product_category_belongs')->insert([
                'product_id' => $product->id,
                'product_category_id' => $product_categoryIds,
                'product_subcategory_id' => $subcategoryId,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }

        $notification = [
            'message' => 'Product created successfully!',
            'alert-type' => 'success',
        ];

        return redirect()->route('all.product')->with($notification);
    }
}
