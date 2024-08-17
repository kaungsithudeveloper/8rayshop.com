<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\ProductCategory;
use App\Models\ProductSubCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Brand;
use App\Models\Order;
use Carbon\Carbon;
use Illuminate\Support\Facades\Session;


class FrontendController extends Controller
{

    public function EightRayLogin()
    {
        return view('frontend.8ray.login');
    }

    public function EightRayRegister()
    {
        return view('frontend.8ray.register');
    }

    public function EightRayLogOut(Request $request)
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        $notification = array(
            'message' => 'Successfully logged Out',
            'alert-type' => 'success',
        );

        return redirect('/8ray/login')->with($notification);
    }

    public function EightRayFrontend()
    {
        $productTypeId = 1;


        $newProducts = Product::with(['productInfo', 'productColor', 'brands', 'categories', 'productSubCategory', 'multiImages', 'price'])->where('product_type_id', $productTypeId)
        ->where('status','active')
        ->orderByDesc('updated_at')
        ->take(10)
        ->get();

        $featureProducts = Product::whereHas('productInfo', function ($query) {
            $query->whereNotNull('best_sale');
        })
        ->where('status','active')
        ->with(['productInfo', 'productColor', 'brands', 'categories', 'productSubCategory', 'multiImages', 'price'])
        ->where('product_type_id', $productTypeId)
        ->orderByDesc('updated_at')
        ->take(12)
        ->get();

        $categoryIds = [2, 3, 4, 5]; // Specify the category IDs you want to include

        $productCategories  = Product::whereHas('categories', function ($query) use ($categoryIds) {
                $query->whereIn('id', $categoryIds);
            })
            ->where('status','active')
            ->with(['productInfo', 'productColor', 'brands', 'categories', 'productSubCategory', 'multiImages', 'price'])
            ->where('product_type_id', $productTypeId)
            ->orderByDesc('updated_at')
            ->take(10)
            ->get();


        $soundProductCategoryId = 9; // Specify the category ID you want to include


        $soundProductCategories  = Product::whereHas('categories', function ($query) use ($soundProductCategoryId) {
                    $query->where('id', $soundProductCategoryId);
                })
                ->where('status','active')
                ->with(['productInfo', 'productColor', 'brands', 'categories', 'productSubCategory', 'multiImages', 'price'])
                ->where('product_type_id', $productTypeId)
                ->orderByDesc('updated_at')
                ->take(10)
                ->get();

        $productPhotographyId = 7; // Specify the category ID you want to include

        $productPhotographys  = Product::whereHas('categories', function ($query) use ($productPhotographyId) {
            $query->where('id', $productPhotographyId);
        })
        ->where('status','active')
        ->with(['productInfo', 'productColor', 'brands', 'categories', 'productSubCategory', 'multiImages', 'price'])
        ->where('product_type_id', $productTypeId)
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
        $brands = Brand::with('products')->latest()->orderByDesc('updated_at')->paginate(18);
        return view('frontend.8ray.brandzone', compact('brands'));
    }

    public function BrandZoneProductList(Request $request, $id, $slug)
    {
        $productTypeId = 1;
        $breadbrands = Brand::findOrFail($id);
        $brand = Brand::with(['products' => function ($query) {
            $query->orderByDesc('updated_at');
        }])->findOrFail($id);

        $productsList = $brand->products()->where('product_type_id', $productTypeId)->where('status', 'active')->paginate(16);
        return view('frontend.8ray.brandzone_product_list',compact('breadbrands','productsList'));
    }

    public function AllProductList()
    {
        $productTypeId = 1;
        $productsList = Product::with(['productInfo', 'productColor', 'brands', 'categories', 'productSubCategory', 'multiImages', 'price'])
            ->where('status', 'active')
            ->where('product_type_id', $productTypeId)
            ->orderByDesc('updated_at')
            ->paginate(16);

        return view('frontend.8ray.product_view', compact('productsList'));
    }

    public function ProductDetails($id,$slug)
    {

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

    public function CategoryProductList(Request $request, $ids, $slug)
    {
        $productTypeId = 1;
        $categoryIds = explode(',', $ids); // Convert the comma-separated string to an array

        $categoryProducts = Product::with(['productInfo', 'productColor', 'brands', 'categories', 'productSubCategory', 'multiImages', 'price'])
                            ->where('status', 'active')
                            ->where('product_type_id', $productTypeId)
                            ->whereHas('productCategory', function($query) use ($categoryIds) {
                            $query->whereIn('product_category_id', $categoryIds); // Use whereIn for multiple IDs
                            })
                            ->orderBy('id', 'DESC')
                            ->paginate(16);

        $categories = ProductCategory::orderBy('product_category_name', 'ASC')->get();
        $breadcat = ProductCategory::findOrFail($categoryIds[0]); // Get the first category as breadcrumb

        return view('frontend.8ray.category_view', compact('categoryProducts', 'categories', 'breadcat'));
    }


    public function SubcategoryProductList(Request $request, $id, $slug)
    {
        $productTypeId = 1;
        $subcategoryProducts = Product::with(['productInfo', 'productColor', 'brands', 'categories', 'productSubCategory', 'multiImages', 'price'])
                            ->where('status', 'active')
                            ->where('product_type_id', $productTypeId)
                            ->whereHas('productSubCategory', function($query) use ($id) {
                                $query->where('product_subcategory_id', $id);
                            })
                            ->orderBy('id', 'DESC')
                            ->paginate(16); // Use paginate instead of get()

        $categories = ProductCategory::orderBy('product_category_name', 'ASC')->get();
        $breadsubcat = ProductSubCategory::findOrFail($id);
        $breadcat = $breadsubcat->productCategories()->firstOrFail();

        return view('frontend.8ray.subcategory_view', compact('subcategoryProducts', 'categories', 'breadcat', 'breadsubcat'));
    }

    public function ProductViewAjax($id)
    {
        $product = Product::with([
            'productInfo',
            'brands',
            'categories',
            'productSubCategory',
            'multiImages',
            'price',
            'stocks.branch',
            'comments' => function($query) {
                $query->whereNull('parent_id');
            },
            'colors',
            'comments.user',
            'comments.replies.user' // Eager load replies and their users
        ])->findOrFail($id);

        return response()->json([

            'product' => $product,


        ]);

    }

    public function DatacentreFrontend()
    {
        return view('frontend.datacentre.dashboard');
    }
}
