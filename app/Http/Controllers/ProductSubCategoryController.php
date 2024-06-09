<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ProductCategory;
use App\Models\ProductSubCategory;

use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;

class ProductSubCategoryController extends Controller
{
    public function AllProductSubCategories(){
        $product_categories = ProductCategory::orderBy('product_category_name','ASC')->get();
        $product_subcategories = ProductSubCategory::latest()->get();
        return view('backend.admin.product_subcategory.product_sub_category_all',compact('product_categories','product_subcategories'));
    } // End Method

    public function StoreProductSubCategories(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'product_category_id' => 'required|string|max:255',
            'product_subcategory_name' => 'required|string|max:255|unique:product_sub_categories,product_subcategory_name',
        ]);

        if ($validator->fails()) {

            $notification = [
                'message' => 'The product Subcategory name already exists',
                'alert-type' => 'error',
            ];

            return redirect()->back()->with($notification);
        }

        $product_subcategory = new ProductSubCategory;
        $product_subcategory->product_category_id = $request->input('product_category_id');
        $product_subcategory->product_subcategory_name = $request->input('product_subcategory_name');
        $product_subcategory->product_subcategory_slug = strtolower(str_replace(' ', '-', $request->product_subcategory_name));
        $product_subcategory->save();

        $notification = array(
            'message' => 'Product SubCategory Inserted Successfully',
            'alert-type' => 'success'
        );

        return redirect()->route('all.product.sub_categories')->with($notification);
    }

    public function EditProductSubCategories($slug)
    {
        $product_subcategory = ProductSubCategory::where('product_subcategory_slug', $slug)->firstOrFail();
        $product_subcategories = ProductSubCategory::latest()->get();
        $product_categories = ProductCategory::all();
        return view('backend.admin.product_subcategory.product_sub_category_edit', compact('product_subcategory', 'product_subcategories','product_categories'));
    }


    public function UpdateProductSubCategories(Request $request){

        //dd($request->all());
        $product_subcategory_id = $request->id;

        $validator = Validator::make($request->all(), [
            'product_category_id' => 'required|string|max:255',
            'product_subcategory_name' => 'required|string|max:255|unique:product_sub_categories,product_subcategory_name',
        ]);

        if ($validator->fails()) {

            $notification = [
                'message' => 'The product Subcategory name already exists',
                'alert-type' => 'error',
            ];

            return redirect()->back()->with($notification);
        }

        $product_subcategory = ProductSubCategory::findOrFail($product_subcategory_id);
        $product_subcategory->product_category_id = $request->input('product_category_id');
        $product_subcategory->product_subcategory_name = $request->input('product_subcategory_name');
        $product_subcategory->product_subcategory_slug = strtolower(str_replace(' ', '-', $request->product_subcategory_name));
        $product_subcategory->save();

       $notification = array(
            'message' => 'SubCategory Updated Successfully',
            'alert-type' => 'success'
        );

        return redirect()->route('all.product.sub_categories')->with($notification);


    }// End Method


    public function DestoryProductSubCategories($id)
    {
        $product_category = ProductCategory::findOrFail($id);
        $imagePath = public_path('upload/product_category_images/' . $product_category->product_category_image);
        if (file_exists($imagePath) && is_file($imagePath)) {
            unlink($imagePath);
        }

        $product_category->delete();

        $notification = array(
            'message' => 'Brand Deleted Successfully',
            'alert-type' => 'success'
        );

        return redirect()->route('all.product.categories')->with($notification);
    }// End Method

}
