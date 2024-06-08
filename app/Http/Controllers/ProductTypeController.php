<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ProductType;

use Illuminate\Support\Facades\Validator;

class ProductTypeController extends Controller
{
    public function AllProductType(){
        $product_types = ProductType::latest()->get();
        return view('backend.product_type.product_type_all',compact('product_types'));
    } // End Method

    public function StoreProductType(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'product_type_name' => 'required|string|max:255|unique:product_types,product_type_name',
        ]);

        if ($validator->fails()) {

            $notification = [
                'message' => 'The product type name already exists',
                'alert-type' => 'error',
            ];

            return redirect()->back()->with($notification);
        }

        $product_type = new ProductType;
        $product_type->product_type_name = $request->input('product_type_name');
        $product_type->product_type_slug = strtolower(str_replace(' ', '-', $request->product_type_name));
        $product_type->save();

        $notification = array(
            'message' => 'Product Type Inserted Successfully',
            'alert-type' => 'success'
        );

        return redirect()->route('all.product.types')->with($notification);
    }

    public function EditProductType($slug)
    {
        $product_type = ProductType::where('product_type_slug', $slug)->firstOrFail();
        $product_types = ProductType::latest()->get();
        return view('backend.product_type.product_type_edit', compact('product_type', 'product_types'));
    }

    public function UpdateProductType(Request $request){

        //dd($request->all());
        $product_type_id = $request->id;

        $validator = Validator::make($request->all(), [
            'product_type_name' => 'required|string|max:255|unique:product_types,product_type_name',
        ]);

        if ($validator->fails()) {

            $notification = [
                'message' => 'The Product Type name already exists',
                'alert-type' => 'error',
            ];

            return redirect()->back()->with($notification);
        }

        $product_type = ProductType::findOrFail($product_type_id);
        $product_type->product_type_name = $request->input('product_type_name');
        $product_type->product_type_slug = strtolower(str_replace(' ', '-', $request->product_type_name));
        $product_type->save();

       $notification = array(
            'message' => 'Product Type Updated Successfully',
            'alert-type' => 'success'
        );

        return redirect()->route('all.product.types')->with($notification);


    }// End Method


    public function DestoryProductType($id)
    {
        $product_type = ProductType::findOrFail($id);
        $product_type->delete();

        $notification = array(
            'message' => 'Product Type Deleted Successfully',
            'alert-type' => 'success'
        );

        return redirect()->route('all.product.types')->with($notification);
    }// End Method
}
