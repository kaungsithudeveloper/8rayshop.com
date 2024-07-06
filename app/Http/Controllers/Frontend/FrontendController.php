<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Brand;

class FrontendController extends Controller
{

    public function EightRayLogin(){
        return view('frontend.8ray.login');
    }

    public function EightRayRegister(){
        return view('frontend.8ray.register');
    }

    public function EightRayLogOut(Request $request)
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/8ray/login');
    }

    public function EightRayFrontend()
    {
        $newProducts = Product::with(['productInfo', 'productColor', 'brands', 'categories', 'productSubCategory', 'multiImages', 'price'])
        ->orderByDesc('updated_at')
        ->take(10)
        ->get();

        $featureProducts = Product::whereHas('productInfo', function ($query) {
            $query->whereNotNull('best_sale');
        })
        ->with(['productInfo', 'productColor', 'brands', 'categories', 'productSubCategory', 'multiImages', 'price'])
        ->orderByDesc('updated_at')
        ->take(12)
        ->get();

        $categoryIds = [2, 3, 4, 5]; // Specify the category IDs you want to include

        $productCategories  = Product::whereHas('categories', function ($query) use ($categoryIds) {
                $query->whereIn('id', $categoryIds);
            })
            ->with(['productInfo', 'productColor', 'brands', 'categories', 'productSubCategory', 'multiImages', 'price'])
            ->orderByDesc('updated_at')
            ->take(10)
            ->get();


        $soundProductCategoryId = 9; // Specify the category ID you want to include


        $soundProductCategories  = Product::whereHas('categories', function ($query) use ($soundProductCategoryId) {
                    $query->where('id', $soundProductCategoryId);
                })
                ->with(['productInfo', 'productColor', 'brands', 'categories', 'productSubCategory', 'multiImages', 'price'])
                ->orderByDesc('updated_at')
                ->take(10)
                ->get();

        $productPhotographyId = 7; // Specify the category ID you want to include

        $productPhotographys  = Product::whereHas('categories', function ($query) use ($productPhotographyId) {
            $query->where('id', $productPhotographyId);
        })
        ->with(['productInfo', 'productColor', 'brands', 'categories', 'productSubCategory', 'multiImages', 'price'])
        ->orderByDesc('updated_at')
        ->take(10)
        ->get();

        return view('frontend.8ray.dashboard', compact('newProducts','featureProducts','productCategories','soundProductCategories','productPhotographys'));
    }

    public function contactUs()
    {
        return view('frontend.8ray.contact_us');
    }

    public function aboutUs()
    {
        return view('frontend.8ray.about_us');
    }

    public function brandZone()
    {
        $brands = Brand::latest()->get();
        $products = Product::with('multiImages')->first(); // Fetch a specific product or use find($id) to fetch by ID
        return view('frontend.8ray.brandzone', compact('brands', 'products'));
    }

    public function ProductDetails($id,$slug){

        $product = Product::with([
            'productInfo',
            'productColor',
            'brands',
            'categories',
            'productSubCategory',
            'multiImages',
            'price',
            'stocks.branch',
            'comments' => function($query) {
                $query->whereNull('parent_id');
            },
            'comments.user',
            'comments.replies.user' // Eager load replies and their users
        ])->findOrFail($id);

        $commentCount = $product->comments->count();

        return view('frontend.8ray.product_details',compact('product', 'commentCount'));

     }


    public function DatacentreFrontend()
    {
        return view('frontend.datacentre.dashboard');
    }
}
