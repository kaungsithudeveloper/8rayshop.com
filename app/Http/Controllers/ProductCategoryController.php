<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ProductCategory;
use Intervention\Image\Facades\Image;

use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;

class ProductCategoryController extends Controller
{
    public function AllProductCategories(){
        $product_categories = ProductCategory::latest()->get();
        return view('backend.admin.product_category.product_category_all',compact('product_categories'));
    } // End Method

    public function StoreProductCategories(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'product_category_name' => 'required|string|max:255|unique:product_categories,product_category_name',
            'product_category_image' => 'required|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        if ($validator->fails()) {

            $notification = [
                'message' => 'The product category name already exists',
                'alert-type' => 'error',
            ];

            return redirect()->route('all.product.categories')->with($notification);
        }

        $product_category = new ProductCategory;
        $product_category->product_category_name = $request->input('product_category_name');
        $product_category->product_category_slug = strtolower(str_replace(' ', '-', $request->product_category_name));

        // Handle photo upload
        if ($request->hasFile('product_category_image')) {
            $image = $request->file('product_category_image');
            $imageName = hexdec(uniqid()) . '.' . $image->getClientOriginalExtension();
            $imagePath = 'upload/product_category_images/' . $imageName;

            // Save the image and update user's photo field
            Image::make($image)->save(public_path($imagePath));
            $product_category->product_category_image = $imageName;
        }

        $product_category->save();

        $notification = [
            'message' => 'Product Category Create Successfully',
            'alert-type' => 'success',
        ];

        return redirect()->route('all.product.categories')->with($notification);
    }

    public function EditProductCategories($slug)
    {
        $product_category = ProductCategory::where('product_category_slug', $slug)->firstOrFail();
        $product_categories = ProductCategory::latest()->get();
        return view('backend.admin.product_category.product_category_edit', compact('product_category', 'product_categories'));
    }

    public function UpdateProductCategories(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'product_category_name' => 'required|string|max:255|unique:product_categories,product_category_name',
            'product_category_image' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);


        if ($validator->fails()) {

            $notification = [
                'message' => 'The product category name already exists',
                'alert-type' => 'error',
            ];

            return redirect()->back()->with($notification);
        }

        $product_category = ProductCategory::findOrFail($request->id);
        $product_category->product_category_name = $request->input('product_category_name');
        $product_category->product_category_slug = strtolower(str_replace(' ', '-', $request->product_category_name));

        // Handle photo upload
        if ($request->hasFile('product_category_image')) {
            $image = $request->file('product_category_image');
            $imageName = hexdec(uniqid()) . '.' . $image->getClientOriginalExtension();
            $imagePath = 'upload/product_category_images/' . $imageName;

            // Save the image
            Image::make($image)->save(public_path($imagePath));

            // Delete the old photo if it exists
            if ($product_category->product_category_image) {
                $oldImagePath = public_path('upload/product_category_images/' . $product_category->product_category_image);
                if (file_exists($oldImagePath) && is_file($oldImagePath)) {
                    unlink($oldImagePath);
                }
            }

            // Update the brand's image path
            $product_category->product_category_image = $imageName;
        }

        $product_category->save();

        $notification = [
            'message' => 'Product Category updated successfully',
            'alert-type' => 'success',
        ];

        return redirect()->route('all.product.categories')->with($notification);
    }

    public function DestoryProductCategories($id)
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
