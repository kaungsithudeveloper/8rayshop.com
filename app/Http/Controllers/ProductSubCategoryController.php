<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ProductCategory;
use App\Models\ProductSubCategory;

use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class ProductSubCategoryController extends Controller
{
    public function AllProductSubCategories(){
        $product_categories = ProductCategory::orderBy('product_category_name','ASC')->get();
        $product_subcategories = ProductSubCategory::with('productCategories')->latest()->get();
        return view('backend.admin.product_subcategory.product_sub_category_all',compact('product_categories','product_subcategories'));
    } // End Method

    public function StoreProductSubCategories(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'product_categories_id' => 'required|string|max:255',
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
        $product_subcategory->product_subcategory_name = $request->input('product_subcategory_name');
        $product_subcategory->product_subcategory_slug = strtolower(str_replace(' ', '-', $request->product_subcategory_name));
        $product_subcategory->save();


        DB::table('category_subcategory_belongs')->insert([
            'product_category_id' => $request->input('product_categories_id'),
            'product_subcategory_id' => $product_subcategory->id,
        ]);

        // Commit the transaction
        DB::commit();

        $notification = array(
            'message' => 'Product SubCategory Inserted Successfully',
            'alert-type' => 'success'
        );

        return redirect()->route('all.product.sub_categories')->with($notification);
    }// End Method

    public function EditProductSubCategories($slug)
    {
        $product_subcategory = ProductSubCategory::with('productCategories')->where('product_subcategory_slug', $slug)->firstOrFail();
        $product_subcategories = ProductSubCategory::latest()->get();
        $product_categories = ProductCategory::all();
        return view('backend.admin.product_subcategory.product_sub_category_edit', compact('product_subcategory', 'product_subcategories','product_categories'));
    }// End Method


    public function UpdateProductSubCategories(Request $request)
    {
        $product_subcategory_id = $request->id;
        $product_subcategory = ProductSubCategory::findOrFail($product_subcategory_id);

        // Check if the subcategory name is different from the existing one
        $isUniqueName = $request->input('product_subcategory_name') !== $product_subcategory->product_subcategory_name;

        // Validate the request
        $validatorRules = [
            'product_categories_id' => 'required|exists:product_categories,id',
            'product_subcategory_name' => $isUniqueName ? 'required|string|max:255|unique:product_sub_categories,product_subcategory_name' : 'required|string|max:255',
        ];

        $validator = Validator::make($request->all(), $validatorRules);

        if ($validator->fails()) {
            $notification = [
                'message' => 'Validation failed: ' . implode(', ', $validator->errors()->all()),
                'alert-type' => 'error',
            ];

            return redirect()->back()->with($notification);
        }

        if ($isUniqueName) {
            $product_subcategory->product_subcategory_name = $request->input('product_subcategory_name');
            $product_subcategory->product_subcategory_slug = strtolower(str_replace(' ', '-', $request->input('product_subcategory_name')));
            $product_subcategory->save();
        }

            DB::table('category_subcategory_belongs')->updateOrInsert(
                ['product_subcategory_id' => $product_subcategory_id],
                ['product_category_id' => $request->input('product_categories_id')]
            );

        $notification = [
            'message' => 'SubCategory Updated Successfully',
            'alert-type' => 'success'
        ];

        return redirect()->route('all.product.sub_categories')->with($notification);
    }// End Method

    public function DestoryProductSubCategories($id)
    {
        $product_subcategory = ProductSubCategory::findOrFail($id);
        $product_subcategory->delete();

        $notification = array(
            'message' => 'SubCategory Deleted Successfully',
            'alert-type' => 'success'
        );

        return redirect()->route('all.product.sub_categories')->with($notification);
    }// End Method

    public function getSubCategory($category_id)
    {
        $subcategories = ProductCategory::find($category_id)->subcategories()->orderBy('product_subcategory_name', 'ASC')->get();
        return response()->json($subcategories);
    }// End Method


    //Start Employee Product Sub Categories

    public function AllEmployeeProductSubCategories(){
        $product_categories = ProductCategory::orderBy('product_category_name','ASC')->get();
        $product_subcategories = ProductSubCategory::with('productCategories')->latest()->get();
        return view('backend.employees.8ray.product_subcategory.product_sub_category_all',compact('product_categories','product_subcategories'));
    } // End Method
    public function StoreEmployeeProductSubCategories(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'product_categories_id' => 'required|string|max:255',
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
        $product_subcategory->product_subcategory_name = $request->input('product_subcategory_name');
        $product_subcategory->product_subcategory_slug = strtolower(str_replace(' ', '-', $request->product_subcategory_name));
        $product_subcategory->save();


        DB::table('category_subcategory_belongs')->insert([
            'product_category_id' => $request->input('product_categories_id'),
            'product_subcategory_id' => $product_subcategory->id,
        ]);

        // Commit the transaction
        DB::commit();

        $notification = array(
            'message' => 'Product SubCategory Inserted Successfully',
            'alert-type' => 'success'
        );

        return redirect()->route('all.employee.product.sub_categories')->with($notification);
    }// End Method
    public function EditEmployeeProductSubCategories($slug)
    {
        $product_subcategory = ProductSubCategory::with('productCategories')->where('product_subcategory_slug', $slug)->firstOrFail();
        $product_subcategories = ProductSubCategory::latest()->get();
        $product_categories = ProductCategory::all();
        return view('backend.employees.8ray.product_subcategory.product_sub_category_edit', compact('product_subcategory', 'product_subcategories','product_categories'));
    }// End Method
    public function UpdateEmployeeProductSubCategories(Request $request)
    {
        $product_subcategory_id = $request->id;
        $product_subcategory = ProductSubCategory::findOrFail($product_subcategory_id);

        // Check if the subcategory name is different from the existing one
        $isUniqueName = $request->input('product_subcategory_name') !== $product_subcategory->product_subcategory_name;

        // Validate the request
        $validatorRules = [
            'product_categories_id' => 'required|exists:product_categories,id',
            'product_subcategory_name' => $isUniqueName ? 'required|string|max:255|unique:product_sub_categories,product_subcategory_name' : 'required|string|max:255',
        ];

        $validator = Validator::make($request->all(), $validatorRules);

        if ($validator->fails()) {
            $notification = [
                'message' => 'Validation failed: ' . implode(', ', $validator->errors()->all()),
                'alert-type' => 'error',
            ];

            return redirect()->back()->with($notification);
        }

        if ($isUniqueName) {
            $product_subcategory->product_subcategory_name = $request->input('product_subcategory_name');
            $product_subcategory->product_subcategory_slug = strtolower(str_replace(' ', '-', $request->input('product_subcategory_name')));
            $product_subcategory->save();
        }

            DB::table('category_subcategory_belongs')->updateOrInsert(
                ['product_subcategory_id' => $product_subcategory_id],
                ['product_category_id' => $request->input('product_categories_id')]
            );

        $notification = [
            'message' => 'SubCategory Updated Successfully',
            'alert-type' => 'success'
        ];

        return redirect()->route('all.employee.product.sub_categories')->with($notification);
    }// End Method

    public function DestoryEmployeeProductSubCategories($id)
    {
        $product_subcategory = ProductSubCategory::findOrFail($id);
        $product_subcategory->delete();

        $notification = array(
            'message' => 'SubCategory Deleted Successfully',
            'alert-type' => 'success'
        );

        return redirect()->route('all.employee.product.sub_categories')->with($notification);
    }// End Method

    //End Employee Product Sub Categories

}
