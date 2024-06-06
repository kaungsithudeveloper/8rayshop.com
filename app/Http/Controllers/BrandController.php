<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Brand;
use Intervention\Image\Facades\Image;

use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;

class BrandController extends Controller
{
    public function AllBrand(){
        $brands = Brand::latest()->get();
        return view('backend.brand.brand_all',compact('brands'));
    } // End Method

    public function StoreBrand(Request $request)
    {
        try {

            $validator = Validator::make($request->all(), [
                'brand_name' => 'required|string|max:255',
                'brand_image' => 'required|image|mimes:jpeg,png,jpg|max:2048',
            ]);

            if ($validator->fails()) {
                return back()->withErrors($validator)->withInput();
            }

            $brand = new Brand;
            $brand->brand_name = $request->input('brand_name');
            $brand->brand_slug = strtolower(str_replace(' ', '-', $request->brand_name));

            // Handle photo upload
            if ($request->hasFile('brand_image')) {
                $image = $request->file('brand_image');
                $imageName = hexdec(uniqid()) . '.' . $image->getClientOriginalExtension();
                $imagePath = 'upload/brand_images/' . $imageName;

                // Save the image and update user's photo field
                Image::make($image)->save(public_path($imagePath));
                $brand->brand_image = $imageName;

                // Delete the old photo if it exists
                if ($brand->brand_image) {
                    Storage::delete('upload/brand_images/' . $brand->photo);
                }
            }

            $brand->save();

            $notification = [
                'message' => 'Brand Create Successfully',
                'alert-type' => 'success',
            ];

            return redirect()->route('all.brand')->with($notification);
        } catch (\Exception $e) {
            Log::error('Error Creating Brand: ' . $e->getMessage());

            $notification = [
                'message' => 'An error occurred while Creating brand.',
                'alert-type' => 'error',
            ];

            return back()->with($notification);
        }
    }

    public function EditBrand($slug)
    {
        $brand = Brand::where('brand_slug', $slug)->firstOrFail();
        $brands = Brand::latest()->get();
        return view('backend.brand.brand_edit', compact('brands', 'brand'));
    }

    public function UpdateBrand(Request $request)
    {
        try {
            $validator = Validator::make($request->all(), [
                'brand_name' => 'required|string|max:255',
                'brand_image' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            ]);

            if ($validator->fails()) {
                return back()->withErrors($validator)->withInput();
            }

            $brand = Brand::findOrFail($request->id);
            $brand->brand_name = $request->input('brand_name');
            $brand->brand_slug = strtolower(str_replace(' ', '-', $request->brand_name));

            // Handle photo upload
            if ($request->hasFile('brand_image')) {
                $image = $request->file('brand_image');
                $imageName = hexdec(uniqid()) . '.' . $image->getClientOriginalExtension();
                $imagePath = 'upload/brand_images/' . $imageName;

                // Save the image
                Image::make($image)->save(public_path($imagePath));

                // Delete the old photo if it exists
                if ($brand->brand_image) {
                    $oldImagePath = public_path('upload/brand_images/' . $brand->brand_image);
                    if (file_exists($oldImagePath) && is_file($oldImagePath)) {
                        unlink($oldImagePath);
                    }
                }

                // Update the brand's image path
                $brand->brand_image = $imageName;
            }

            $brand->save();

            $notification = [
                'message' => 'Brand updated successfully',
                'alert-type' => 'success',
            ];

            return redirect()->route('all.brand')->with($notification);
        } catch (\Exception $e) {
            Log::error('Error updating brand: ' . $e->getMessage());

            $notification = [
                'message' => 'An error occurred while updating the brand.',
                'alert-type' => 'error',
            ];

            return back()->with($notification);
        }
    }

    public function DestoryBrand($id)
    {
        $brand = Brand::findOrFail($id);
        $imagePath = public_path('upload/brand_images/' . $brand->brand_image);
        if (file_exists($imagePath) && is_file($imagePath)) {
            unlink($imagePath);
        }

        $brand->delete();

        $notification = array(
            'message' => 'Brand Deleted Successfully',
            'alert-type' => 'success'
        );

        return redirect()->route('all.brand')->with($notification);
    }// End Method

}
