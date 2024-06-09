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
                'message' => 'The product name already exists',
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
        if ($request->hasFile('product_photo')) {
            $image = $request->file('product_photo');
            $imageName = hexdec(uniqid()) . '.' . $image->getClientOriginalExtension();
            $imagePath = 'upload/product_images/' . $imageName;

            // Compress and save the image
            Image::make($image)
                ->resize(800, null, function ($constraint) {
                    $constraint->aspectRatio();
                    $constraint->upsize();
                })
                ->save(public_path($imagePath), 75); // Adjust the quality to compress

            $product->product_photo = $imageName;
        }
        $product->created_at = Carbon::now();
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


        $product_info->created_at = Carbon::now();
        $product_info->save();


        if ($request->hasFile('multi_img')) {
            foreach ($request->file('multi_img') as $img) {
                $imageName = hexdec(uniqid()) . '.' . $img->getClientOriginalExtension();
                $imagePath = 'upload/product_multi_images/' . $imageName;

                // Compress and save the image
                Image::make($img)
                    ->resize(800, null, function ($constraint) {
                        $constraint->aspectRatio();
                        $constraint->upsize();
                    })
                    ->save(public_path($imagePath), 75); // Adjust the quality to compress

                // Save the image info to the database
                $product_multiImage = new MultiImg();
                $product_multiImage->product_id = $product->id;
                $product_multiImage->photo_name = $imageName;
                $product_multiImage->created_at = Carbon::now();
                $product_multiImage->save();
            }
        }

        $notification = [
            'message' => 'Product Create Successfully',
            'alert-type' => 'success',
        ];


        return redirect()->route('all.product')->with($notification);
    }
}
