<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Product;
use App\Models\Stock;
use App\Models\Branch;
use App\Models\Brand;
use Illuminate\Support\Facades\Validator;

class StockController extends Controller
{


    public function AllStock()
    {
        $products = Product::latest()->get();
        $productStock = Stock::with('product')->latest()->get();  // Eager load the product relationship
        $branches = Branch::latest()->get();
        $brands = Brand::latest()->get();
        return view('backend.admin.stock.stock_all', compact('products', 'productStock', 'branches','brands'));
    }

    public function fetchProductsByBrand(Request $request)
    {
        $brand_id = $request->input('brand_id');

        // Query the products based on brand_id
        $products = Product::whereHas('brands', function ($query) use ($brand_id) {
            $query->where('brands.id', $brand_id);
        })->get();

        return response()->json(['products' => $products]);
    }

    public function fetchStock(Request $request)
    {
        $product_id = $request->input('product_id');
        $branch_id = $request->input('branch_id');

        // Query the stock based on product_id and branch_id
        $stock = Stock::where('product_id', $product_id)
                    ->where('branch_id', $branch_id)
                    ->first();

        if ($stock) {
            return response()->json(['stock_qty' => $stock->stock_qty]);
        } else {
            return response()->json(['stock_qty' => '']);
        }
    }

    public function StoreStock(Request $request)
    {
        // Validation
        $validator = Validator::make($request->all(), [
            'product_id' => 'required|integer|exists:products,id',
            'brand_id' => 'required|integer|exists:brands,id',
            'branch_id' => 'required|integer|exists:branches,id',
            'stock_qty' => 'required|integer|min:1',
        ]);

        if ($validator->fails()) {
            $notification = [
                'message' => 'Validation failed.',
                'alert-type' => 'error',
            ];
            return redirect()->back()->withErrors($validator)->withInput()->with($notification);
        }

        $validatedData = $validator->validated();

        // Find existing stock or create new
        $product_stock = new Stock();
        $product_stock->product_id = $request->input('product_id');
        $product_stock->brand_id = $request->input('brand_id');
        $product_stock->branch_id = $request->input('branch_id');
        $product_stock->stock_qty = $request->input('stock_qty');
        $product_stock->save();

        $notification = [
            'message' => 'Product stock updated successfully!',
            'alert-type' => 'success',
        ];

        return redirect()->route('all.stock')->with($notification);
    }

    public function EditStock($id)
    {
        $stock = Stock::findOrFail($id);  // Fetch the stock to be edited
        $products = Product::latest()->get();
        $productStock = Stock::with('product')->latest()->get();
        $branches = Branch::latest()->get();
        $brands = Brand::latest()->get();
        return view('backend.admin.stock.stock_edit', compact('stock', 'products','productStock', 'branches', 'brands'));
    }

    public function UpdateStock(Request $request, $id)
    {
        // Validation
        //dd($request->all());

        $validator = Validator::make($request->all(), [
            'product_id' => 'required|integer|exists:products,id',
            'brand_id' => 'required|integer|exists:brands,id',
            'branch_id' => 'required|integer|exists:branches,id',
            'stock_qty' => 'required|integer|min:1',
        ]);

        if ($validator->fails()) {
            $notification = [
                'message' => 'Validation failed.',
                'alert-type' => 'error',
            ];
            return redirect()->back()->withErrors($validator)->withInput()->with($notification);
        }

        $validatedData = $validator->validated();

        // Find existing stock
        $product_stock = Stock::findOrFail($id);
        $product_stock->product_id = $request->input('product_id');
        $product_stock->brand_id = $request->input('brand_id');
        $product_stock->branch_id = $request->input('branch_id');
        $product_stock->stock_qty = $request->input('stock_qty');
        $product_stock->save();

        $notification = [
            'message' => 'Product stock updated successfully!',
            'alert-type' => 'success',
        ];

        return redirect()->route('all.stock')->with($notification);
    }

    public function DestoryStock($id)
    {
        $product_stock = Stock::findOrFail($id);
        $product_stock->delete();

        $notification = array(
            'message' => 'Stock Deleted Successfully',
            'alert-type' => 'success'
        );

        return redirect()->route('all.stock')->with($notification);
    }


}
