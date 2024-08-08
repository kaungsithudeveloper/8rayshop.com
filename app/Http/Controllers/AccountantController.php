<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Brand;

class AccountantController extends Controller
{
    public function index()
    {
        $brands = Brand::with('products.price', 'products.stocks')->get();
        $profitLossData = [];

        foreach ($brands as $brand) {
            $profitLossData[] = [
                'brand_name' => $brand->brand_name,
                'product_count' => $brand->products->count(),
                'profit' => $brand->calculateProfitLoss()['profit'],
                'loss' => $brand->calculateProfitLoss()['loss'],
            ];
        }

        return view('backend.admin.accountant.accountant', compact('profitLossData'));
    }


    public function showBrandDetail($brand_slug)
    {
        $brand = Brand::where('brand_slug', $brand_slug)->with('products.price', 'products.stocks')->firstOrFail();
        $profitLossData = [
            'brand_name' => $brand->brand_name,
            'product_count' => $brand->products->count(),
            'profit' => $brand->calculateProfitLoss()['profit'],
            'loss' => $brand->calculateProfitLoss()['loss'],
            'brand_image' => $brand->brand_image,
        ];

        $productProfitLossData = [];

        foreach ($brand->products as $product) {
            $productProfitLossData[] = [
                'product_name' => $product->product_name,
                'profit' => $product->calculateProfitLoss()['profit'],
                'loss' => $product->calculateProfitLoss()['loss'],
                'total_stock' => $product->total_stock,
                'error_stock' => $product->error_stock,
                'sold_stock' => $product->sold_stock,
            ];
        }

        return view('backend.admin.accountant.brand_detail', compact('brand', 'profitLossData', 'productProfitLossData'));
    }

}
