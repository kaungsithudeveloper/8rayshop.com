<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Brand;
use Intervention\Image\Facades\Image;

use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;

class EmployeeBrandController extends Controller
{
    public function AllEmployeeBrand(){
        $brands = Brand::latest()->get();
        return view('backend.employees.8ray.brands.brand_all',compact('brands'));
    } // End Method

    public function StoreEmployeeBrand(Request $request)
    {
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

        return redirect()->route('all.employee.brand')->with($notification);
    }

    public function EditEmployeeBrand($slug)
    {
        $brand = Brand::where('brand_slug', $slug)->firstOrFail();
        $brands = Brand::latest()->get();
        return view('backend.employees.8ray.brands.brand_edit', compact('brands', 'brand'));
    }

    public function UpdateEmployeeBrand(Request $request)
    {
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

        return redirect()->route('all.employee.brand')->with($notification);
    }

    public function DestoryEmployeeBrand($id)
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

        return redirect()->route('all.employee.brand')->with($notification);
    }// End Method
}
