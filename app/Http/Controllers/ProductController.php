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
            'product_qty' => 'required|integer',
            'selling_price' => 'required|string|max:255',
            'brand_id' => 'nullable|string|max:255',
            'product_categories_id' => 'nullable|string|max:255',
            'product_sub_categories_id' => 'nullable|string|max:255',
            'product_type_id' => 'required|exists:product_types,id',
            'long_descp' => 'required|string|max:255',
            'short_descp' => 'required|string|max:255',
            'product_size' => 'required|string|max:255',
            'product_color' => 'required|string|max:255',


        ]);

        if ($validator->fails()) {

            $notification = [
                'message' => 'some error occurred',
                'alert-type' => 'error',
            ];

            return redirect()->back()->with($notification);
        }

        $product = new Product();
        $product->product_code = $request->input('product_code');
        $product->product_name = $request->input('product_name');
        $product->product_slug = strtolower(str_replace(' ', '-', $request->product_name));
        $product->product_qty = $request->input('product_qty');
        $product->selling_price = $request->input('selling_price');
        $product->discount_price = $request->input('discount_price');
        $product->user_id = auth()->user()->id;
        $product->status = 'inactive';
        $product->save();

        $product_info = new ProductInfo();
        $product_info->product_id = $product->id;
        $product_info->short_descp = $request->input('short_descp');
        $product_info->long_descp = $request->input('long_descp');
        $product_info->brand_id = $request->input('brand_id');
        $product_info->product_categories_id = $request->input('product_categories_id');
        $product_info->product_sub_categories_id = $request->input('product_sub_categories_id');
        $product_info->product_type_id = $request->input('product_type_id');
        $product_info->product_size = $request->input('product_size');
        $product_info->product_color = $request->input('product_color');

        if ($request->hasFile('product_photo')) {
            $image = $request->file('product_photo');
            $imageName = hexdec(uniqid()) . '.' . $image->getClientOriginalExtension();
            $imagePath = 'upload/product_info_images/' . $imageName;

            // Save the image and update user's photo field
            Image::make($image)->save(public_path($imagePath));
            $product_info->product_photo = $imageName;
        }

        $product_info->save();

        $notification = [
            'message' => 'Product Category Create Successfully',
            'alert-type' => 'success',
        ];


        return redirect()->route('all.product')->with('success', 'Product created successfully.');
    }
}
