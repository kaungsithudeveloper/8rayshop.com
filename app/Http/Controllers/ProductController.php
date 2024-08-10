<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Product;
use App\Models\ProductCategory;
use App\Models\ProductSubCategory;
use App\Models\ProductType;
use App\Models\ProductColor;
use App\Models\ProductInfo;
use App\Models\MultiImg;
use App\Models\Brand;
use App\Models\Price;
use App\Models\Stock;
use App\Models\Branch;
use App\Models\Accountant;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Validator;
use Carbon\Carbon;
use Cohensive\Embed\Embed;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;


class ProductController extends Controller
{
    public function AllProduct()
    {
        $products = Product::with([
            'productInfo',
            'productColor',
            'brands',
            'categories',
            'productSubCategory',
            'multiImages',
            'price',
            'stocks.branch'
        ])->latest()->get();

        $activeProducts = Product::where('status', 'active')->with([
            'productInfo',
            'productColor',
            'brands',
            'categories',
            'productSubCategory',
            'multiImages',
            'price',
            'stocks.branch'
        ])->latest()->get();

        $inActiveProduct = Product::where('status', 'inactive')->with([
            'productInfo',
            'productColor',
            'brands',
            'categories',
            'productSubCategory',
            'multiImages',
            'price',
            'stocks.branch'
        ])->latest()->get();

        return view('backend.admin.product.product_all', compact('products', 'activeProducts', 'inActiveProduct'));
    }


    public function AddProduct(){

        $product_type = ProductType::orderBy('product_type_name','ASC')->get();
        $brands = Brand::orderBy('brand_name','ASC')->get();
        $branches = Branch::latest()->get();
        $product_categories = ProductCategory::orderBy('product_category_name','ASC')->get();
        $product_subCategories = ProductSubCategory::orderBy('product_subcategory_name','ASC')->get();
        return view('backend.admin.product.product_add',compact('product_type','brands','product_categories','product_subCategories','branches'));

    } // End Method

    public function AddProductAdmin(){

        $product_type = ProductType::orderBy('product_type_name','ASC')->get();
        $brands = Brand::orderBy('brand_name','ASC')->get();
        $branches = Branch::latest()->get();
        $product_categories = ProductCategory::orderBy('product_category_name','ASC')->get();
        $product_subCategories = ProductSubCategory::orderBy('product_subcategory_name','ASC')->get();
        return view('backend.admin.product.product_add_admin',compact('product_type','brands','product_categories','product_subCategories','branches'));

    } // End Method


    public function search(Request $request)
    {
        $query = $request->input('query');
        $colors = ProductColor::where('color_name', 'LIKE', "%{$query}%")->get();
        return response()->json($colors);
    }

    public function store(Request $request)
    {
        $color = ProductColor::create([
            'color_name' => $request->input('color_name'),
            'color_slug' => Str::slug($request->input('color_name')),
        ]);
        return response()->json($color);
    }


    private function convertToEmbedUrl($url)
    {
        $parsedUrl = parse_url($url);

        // Check if the 'query' key exists and is not empty
        if (isset($parsedUrl['query']) && !empty($parsedUrl['query'])) {
            parse_str($parsedUrl['query'], $queryParams);

            // Check if 'v' key exists in query parameters
            if (isset($queryParams['v'])) {
                return 'https://www.youtube.com/embed/' . $queryParams['v'];
            }
        }

        // Return the original URL or handle the error appropriately
        return $url;
    }


    public function StoreProduct(Request $request)
    {
        // Validate request
        //dd($request->all());
        $validator = Validator::make($request->all(), [
            'product_code' => 'required|unique:products,product_code|string|max:255',
            'product_name' => 'required|unique:products,product_name|string|max:255',
            'short_descp' => 'required|string',
            'long_descp' => 'required|string',
            'url' => 'required|url',
            'product_size' => 'required|string|max:255',
            'purchase_price' => 'required|string|max:255',
            'selling_price' => 'required|string|max:255',
            'discount_price' => 'required|string|max:255',
            'brand_id' => 'required|string|max:255',
            'product_category_id' => 'required|string|max:255',
            'product_subcategory_id' => 'array',
            'product_subcategory_id.*' => 'integer',
            'product_color_id.*' => 'required|string|max:255',
            'stock_qty_1.*' => 'required|integer|min:0',
            'stock_qty_2.*' => 'required|integer|min:0',
        ]);

        if ($validator->fails()) {
            $notification = [
                'message' => 'Validation failed.',
                'alert-type' => 'error',
            ];
            return redirect()->back()->withErrors($validator)->withInput()->with($notification);
        }

        $validatedData = $validator->validated();

        // Handle file upload


        // Create new product
        $product = new Product();
        $product->product_code = $request->input('product_code');
        $product->product_name = $request->input('product_name');
        $product->product_slug = strtolower(str_replace(' ', '-', $request->product_name));
        $product->user_id = auth()->user()->id;
        $product->product_type_id = 1;
        $product->status = 'inactive';
        if ($request->hasFile('product_photo')) {
            $image = $request->file('product_photo');
            $imageName = hexdec(uniqid()) . '.' . $image->getClientOriginalExtension();
            $imagePath = 'upload/product_images/' . $imageName;

            // Compress and save the image
            Image::make($image)
                ->resize(800, null, function ($constraint) {
                    $constraint->aspectRatio();
                    $constraint->upsize();
                })
                ->save(public_path($imagePath), 75); // Adjust the quality to compress

            $product->product_photo = $imageName;
        }
        $product->created_at = Carbon::now();
        $product->save();

        // Store product information
        $product_info = new ProductInfo();
        $product_info->product_id = $product->id;
        $product_info->short_descp = $request->input('short_descp');
        $product_info->long_descp = $request->input('long_descp');
        $product_info->url = $this->convertToEmbedUrl($request->input('url'));
        $product_info->product_size = $request->input('product_size');
        $product_info->new = $request->input('new');
        $product_info->hot = $request->input('hot');
        $product_info->sale = $request->input('sale');
        $product_info->best_sale = $request->input('best_sale');
        $product_info->created_at = Carbon::now();
        $product_info->save();

        // Store product Price
        $product_price = new Price();
        $product_price->product_id = $product->id;
        $product_price->purchase_price = $request->input('purchase_price');
        $product_price->selling_price = $request->input('selling_price');
        $product_price->discount_price = $request->input('discount_price');
        $product_price->created_at = Carbon::now();
        $product_price->save();

        // Calculate total quantity and total purchase price
        $total_qty = array_sum($request->input('stock_qty_1')) + array_sum($request->input('stock_qty_2'));
        $total_purchase_price = $total_qty * $request->input('purchase_price');

        // Store accountant information
        $accountant = new Accountant();
        $accountant->product_id = $product->id;
        $accountant->brand_id = $validatedData['brand_id'];
        $accountant->total_purchase_price = $total_purchase_price;
        $accountant->total_purchase_qty = $total_qty;
        $accountant->purchase_date = Carbon::now();
        $accountant->save();

        // Store product multi image
        if ($request->hasFile('multi_img')) {
            foreach ($request->file('multi_img') as $img) {
                $imageName = hexdec(uniqid()) . '.' . $img->getClientOriginalExtension();
                $imagePath = 'upload/product_multi_images/' . $imageName;

                // Compress and save the image
                Image::make($img)
                    ->resize(800, null, function ($constraint) {
                        $constraint->aspectRatio();
                        $constraint->upsize();
                    })
                    ->save(public_path($imagePath), 75); // Adjust the quality to compress

                // Save the image info to the database
                $product_multiImage = new MultiImg();
                $product_multiImage->product_id = $product->id;
                $product_multiImage->photo_name = $imageName;
                $product_multiImage->created_at = Carbon::now();
                $product_multiImage->save();
            }
        }

        // Handle product colors
        $colorNames = $request->input('product_color_id');
        $productColorIds = [];

        foreach ($colorNames as $colorName) {
            // Decode color name if it's JSON
            $colorArray = json_decode($colorName, true);
            $colorName = $colorArray[0]['value'] ?? $colorName;

            // Find or create the color
            $color = ProductColor::firstOrCreate(
                ['color_name' => $colorName],
                ['color_slug' => Str::slug($colorName)]
            );

            $productColorIds[] = $color->id;
        }

        $product->productColor()->attach($productColorIds);

        $product->brands()->attach($validatedData['brand_id']);
        $product->productCategory()->attach($validatedData['product_category_id']);


        // Create Product SubCategory if product_subcategory_id exists
        if (isset($validatedData['product_subcategory_id'])) {
            $subCategoryIds = [];
            foreach ($validatedData['product_subcategory_id'] as $subCategoryId) {
                $productSubCategory = ProductSubCategory::find($subCategoryId);
                if ($productSubCategory) {
                    $subCategoryIds[] = $productSubCategory->id;
                }
            }
            $product->productSubCategory()->attach($subCategoryIds);
        }

        // Store stock information
        $colorNames = $request->input('product_color_id');
        $stockQuantities1 = $request->input('stock_qty_1');
        $stockQuantities2 = $request->input('stock_qty_2');

        foreach ($colorNames as $index => $colorName) {
            // Decode color name
            $colorArray = json_decode($colorName, true);
            $colorName = $colorArray[0]['value'] ?? $colorName;

            // Find or create the color
            $color = ProductColor::firstOrCreate(
                ['color_name' => $colorName],
                ['color_slug' => Str::slug($colorName)]
            );

            // Store stock for branch 1
            Stock::updateOrCreate(
                [
                    'product_id' => $product->id,
                    'brand_id' => $validatedData['brand_id'], // Replace with actual brand id
                    'branch_id' => 1,
                    'product_color_id' => $color->id,
                ],
                ['purchase_qty' => (int)$stockQuantities1[$index] ?? 0, 'sell_qty' => 0]
            );

            // Store stock for branch 2
            Stock::updateOrCreate(
                [
                    'product_id' => $product->id,
                    'brand_id' => $validatedData['brand_id'], // Replace with actual brand id
                    'branch_id' => 2,
                    'product_color_id' => $color->id,
                ],
                ['purchase_qty' => (int)$stockQuantities2[$index] ?? 0, 'sell_qty' => 0]
            );
        }


        $notification = [
            'message' => 'Product created successfully!',
            'alert-type' => 'success',
        ];

        return redirect()->route('all.product')->with($notification);
    }


    public function EditProduct($slug)
    {
        $product = Product::with(['productInfo', 'productColor', 'brands', 'categories', 'productSubCategory', 'multiImages', 'price', 'stocks', 'colors'])
            ->where('product_slug', $slug)
            ->firstOrFail();

        // Retrieve all necessary related data
        $product_type = ProductType::orderBy('product_type_name', 'ASC')->get();
        $brands = Brand::orderBy('brand_name', 'ASC')->get();
        $branches = Branch::latest()->get();
        $product_categories = ProductCategory::orderBy('product_category_name', 'ASC')->get();
        $product_subCategories = ProductSubCategory::orderBy('product_subcategory_name', 'ASC')->get();

        // Group stocks by color ID and include color name
        $stocksGroupedByColor = $product->stocks->groupBy('product_color_id')
            ->map(function ($group) {
                $color = $group->first()->color; // Assuming each stock has a related color
                return [
                    'product_color_id' => $color->id,
                    'color_name' => $color->color_name,
                    'stock_qty_1' => $group->where('branch_id', 1)->sum('purchase_qty'),
                    'stock_qty_2' => $group->where('branch_id', 2)->sum('purchase_qty'),
                    'stocks' => $group->map(function ($stock) {
                        return [
                            'id' => $stock->id,
                            'branch_id' => $stock->branch_id,
                            'purchase_qty' => $stock->purchase_qty,
                        ];
                    })->all()
                ];
            });

        return view('backend.admin.product.product_edit', [
            'product' => $product,
            'stocksGroupedByColor' => $stocksGroupedByColor,
            'product_type' => $product_type,
            'brands' => $brands,
            'branches' => $branches,
            'product_categories' => $product_categories,
            'product_subCategories' => $product_subCategories,
        ]);
    }

    public function updateProduct(Request $request)
    {
        $id = $request->id;

        // Fetch existing quantities for validation
        $colorIds = $request->input('product_color_id');
        $newQty1 = $request->input('stock_qty_1', []);
        $newQty2 = $request->input('stock_qty_2', []);

        $existingQty1 = [];
        $existingQty2 = [];

        foreach ($colorIds as $index => $colorId) {
            $existingStock1 = Stock::where([
                'product_id' => $id,
                'product_color_id' => $colorId,
                'branch_id' => 1,
            ])->first();

            $existingStock2 = Stock::where([
                'product_id' => $id,
                'product_color_id' => $colorId,
                'branch_id' => 2,
            ])->first();

            $existingQty1[$index] = $existingStock1 ? $existingStock1->purchase_qty : 0;
            $existingQty2[$index] = $existingStock2 ? $existingStock2->purchase_qty : 0;
        }

        // Validation
        $validator = Validator::make($request->all(), [
            'product_code' => 'required|string|max:255',
            'product_name' => 'required|string|max:255',
            'short_descp' => 'required|string',
            'long_descp' => 'required|string',
            'product_size' => 'required|string|max:255',
            'purchase_price' => 'required|numeric',
            'selling_price' => 'required|numeric',
            'discount_price' => 'required|numeric',
            'brand_id' => 'required|numeric',
            'product_category_id' => 'required|numeric',
            'product_subcategory_id' => 'array',
            'product_subcategory_id.*' => 'integer',
            'product_color_id.*' => 'required|string|max:255',
            'stock_qty_1.*' => 'numeric|min:0',
            'stock_qty_2.*' => 'numeric|min:0',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $validatedData = $validator->validated();

        // Update Product
        $product = Product::findOrFail($id);
        $product->update([
            'product_code' => $request->input('product_code'),
            'product_name' => $request->input('product_name'),
            'product_slug' => strtolower(str_replace(' ', '-', $request->input('product_name'))),
            'user_id' => auth()->user()->id,
            'product_type_id' => 1,
            'status' => 'inactive',
            'product_photo' => $request->file('product_photo') ? $this->uploadProductPhoto($request->file('product_photo')) : $product->product_photo,
        ]);

        // Update ProductInfo
        ProductInfo::updateOrCreate(
            ['product_id' => $product->id],
            [
                'short_descp' => $request->input('short_descp'),
                'long_descp' => $request->input('long_descp'),
                'product_size' => $request->input('product_size'),
                'url' => $this->convertToEmbedUrl($request->input('url')),
                'new' => $request->input('new'),
                'hot' => $request->input('hot'),
                'sale' => $request->input('sale'),
                'best_sale' => $request->input('best_sale'),
            ]
        );

        // Update or Create ProductPrice
        Price::updateOrCreate(
            ['product_id' => $product->id],
            [
                'purchase_price' => $request->input('purchase_price'),
                'selling_price' => $request->input('selling_price'),
                'discount_price' => $request->input('discount_price'),
            ]
        );

        // Update Product Brand, Category, and SubCategory
        $product->brands()->sync($validatedData['brand_id']);
        $product->productCategory()->sync($validatedData['product_category_id']);

        if (isset($validatedData['product_subcategory_id'])) {
            $subCategoryIds = [];
            foreach ($validatedData['product_subcategory_id'] as $subCategoryId) {
                $productSubCategory = ProductSubCategory::find($subCategoryId);
                if ($productSubCategory) {
                    $subCategoryIds[] = $productSubCategory->id;
                }
            }
            $product->productSubCategory()->sync($subCategoryIds);
        }

        // Update Stocks and Accountant Entries
        foreach ($colorIds as $index => $colorId) {
            $existingStock1 = Stock::where([
                'product_id' => $product->id,
                'product_color_id' => $colorId,
                'branch_id' => 1,
            ])->first();

            $existingStock2 = Stock::where([
                'product_id' => $product->id,
                'product_color_id' => $colorId,
                'branch_id' => 2,
            ])->first();

            $currentQty1 = $existingStock1 ? $existingStock1->purchase_qty : 0;
            $currentQty2 = $existingStock2 ? $existingStock2->purchase_qty : 0;

            $newQty1 = $request->input('stock_qty_1')[$index] ?? 0;
            $newQty2 = $request->input('stock_qty_2')[$index] ?? 0;

            $diffQty1 = $newQty1 - $currentQty1;
            $diffQty2 = $newQty2 - $currentQty2;

            if ($existingStock1) {
                $existingStock1->update(['purchase_qty' => $newQty1]);
            } else {
                Stock::create([
                    'product_id' => $product->id,
                    'product_color_id' => $colorId,
                    'branch_id' => 1,
                    'purchase_qty' => $newQty1,
                ]);
            }

            if ($existingStock2) {
                $existingStock2->update(['purchase_qty' => $newQty2]);
            } else {
                Stock::create([
                    'product_id' => $product->id,
                    'product_color_id' => $colorId,
                    'branch_id' => 2,
                    'purchase_qty' => $newQty2,
                ]);
            }

            $totalPurchaseQty = $diffQty1 + $diffQty2;
            $totalReduceQty = $currentQty1 - $newQty1 + $currentQty2 - $newQty2;
            $purchasePrice = $request->input('purchase_price');

            if ($totalPurchaseQty > 0) {
                Accountant::create([
                    'product_id' => $product->id,
                    'brand_id' => $validatedData['brand_id'],
                    'total_purchase_qty' => $totalPurchaseQty,
                    'total_purchase_price' => $totalPurchaseQty * $purchasePrice,
                    'purchase_date' => Carbon::now()->toDateString(),
                ]);
            }

            if ($totalReduceQty > 0) {
                Accountant::create([
                    'product_id' => $product->id,
                    'brand_id' => $validatedData['brand_id'],
                    'total_reduce_qty' => $totalReduceQty,
                    'total_purchase_price' => -($totalReduceQty * $purchasePrice),
                    'purchase_date' => Carbon::now()->toDateString(),
                ]);
            }
        }

        // Notify success
        return redirect()->route('all.product')->with('message', 'Product updated successfully!');
    }







    public function deleteMultiImage($id)
    {
        $image = MultiImg::findOrFail($id);
        if (file_exists(public_path('upload/product_multi_images/'.$image->photo_name))) {
            unlink(public_path('upload/product_multi_images/'.$image->photo_name));
        }
        $image->delete();
        return response()->json(['success' => 'Image deleted successfully!']);
    }

    public function updateMultiImages(Request $request)
    {
        $productId = $request->product_id;

        if ($request->hasFile('multi_img')) {
            foreach ($request->file('multi_img') as $file) {
                $filename = hexdec(uniqid()).'.'.$file->getClientOriginalExtension();
                $file->move(public_path('upload/product_multi_images'), $filename);

                MultiImg::create([
                    'product_id' => $productId,
                    'photo_name' => $filename,
                ]);
            }
        }

        $notification = [
            'message' => 'Product created successfully!',
            'alert-type' => 'success',
        ];

        return redirect()->route('all.product')->with($notification);
    }

    public function DestoryProduct($id)
    {
        $product = Product::findOrFail($id);

        // Delete the main product image
        $mainImagePath = public_path('upload/product_images/' . $product->product_photo);
        if (file_exists($mainImagePath) && is_file($mainImagePath)) {
            unlink($mainImagePath);
        }

        // Delete all multi-images associated with the product
        $multiImages = MultiImg::where('product_id', $id)->get();
        foreach ($multiImages as $image) {
            $imagePath = public_path('upload/product_multi_images/' . $image->photo_name);
            if (file_exists($imagePath) && is_file($imagePath)) {
                unlink($imagePath);
            }
            $image->delete();
        }

        // Delete the product itself
        $product->delete();

        $notification = array(
            'message' => 'Product Deleted Successfully',
            'alert-type' => 'success'
        );

        return redirect()->route('all.product')->with($notification);
    }

    public function ProductInactive($id)
    {
        Product::findOrFail($id)->update(['status' => 'inactive']); // Use string value 'inactive'
        $notification = array(
            'message' => 'Product Inactive Successfully',
            'alert-type' => 'success'
        );

        return redirect()->back()->with($notification);
    }

    public function ProductActive($id)
    {
        Product::findOrFail($id)->update(['status' => 'active']); // Use string value 'active'
        $notification = array(
            'message' => 'Product Active Successfully',
            'alert-type' => 'success'
        );

        return redirect()->back()->with($notification);
    }

    public function index()
    {
        $productInfos = Product::with(['productInfo'])->get();
        return view('backend.admin.product.product_youtube_link_test', compact('productInfos'));
    }


    public function storetest(Request $request)
    {
        // Validate request
        //dd($request->all());

        $validator = Validator::make($request->all(), [
            'product_code' => 'required|unique:products,product_code|string|max:255',
            'product_name' => 'required|unique:products,product_name|string|max:255',
            'short_descp' => 'required|string',
            'long_descp' => 'required|string',
            'url' => 'required|url',
            'product_size' => 'required|string|max:255',
            'purchase_price' => 'required|string|max:255',
            'selling_price' => 'required|string|max:255',
            'discount_price' => 'required|string|max:255',
            'brand_id' => 'required|string|max:255',
            'product_category_id' => 'required|string|max:255',
            'product_subcategory_id' => 'array',
            'product_subcategory_id.*' => 'integer',
            'product_color_id.*' => 'required|string|max:255',
            'stock_qty_1.*' => 'required|integer|min:0',
            'stock_qty_2.*' => 'required|integer|min:0',
        ]);

        if ($validator->fails()) {
            $notification = [
                'message' => 'Validation failed.',
                'alert-type' => 'error',
            ];
            return redirect()->back()->withErrors($validator)->withInput()->with($notification);
        }

        $validatedData = $validator->validated();

        // Handle file upload


        // Create new product
        $product = new Product();
        $product->product_code = $request->input('product_code');
        $product->product_name = $request->input('product_name');
        $product->product_slug = strtolower(str_replace(' ', '-', $request->product_name));
        $product->user_id = auth()->user()->id;
        $product->product_type_id = 1;
        $product->status = 'inactive';
        if ($request->hasFile('product_photo')) {
            $image = $request->file('product_photo');
            $imageName = hexdec(uniqid()) . '.' . $image->getClientOriginalExtension();
            $imagePath = 'upload/product_images/' . $imageName;

            // Compress and save the image
            Image::make($image)
                ->resize(800, null, function ($constraint) {
                    $constraint->aspectRatio();
                    $constraint->upsize();
                })
                ->save(public_path($imagePath), 75); // Adjust the quality to compress

            $product->product_photo = $imageName;
        }
        $product->created_at = Carbon::now();
        $product->save();

        // Store product information
        $product_info = new ProductInfo();
        $product_info->product_id = $product->id;
        $product_info->short_descp = $request->input('short_descp');
        $product_info->long_descp = $request->input('long_descp');
        $product_info->url = $this->convertToEmbedUrl($request->input('url'));
        $product_info->product_size = $request->input('product_size');
        $product_info->new = $request->input('new');
        $product_info->hot = $request->input('hot');
        $product_info->sale = $request->input('sale');
        $product_info->best_sale = $request->input('best_sale');
        $product_info->created_at = Carbon::now();
        $product_info->save();

        // Store product Price
        $product_price = new Price();
        $product_price->product_id = $product->id;
        $product_price->purchase_price = $request->input('purchase_price');
        $product_price->selling_price = $request->input('selling_price');
        $product_price->discount_price = $request->input('discount_price');
        $product_price->created_at = Carbon::now();
        $product_price->save();

        // Store product multi image
        if ($request->hasFile('multi_img')) {
            foreach ($request->file('multi_img') as $img) {
                $imageName = hexdec(uniqid()) . '.' . $img->getClientOriginalExtension();
                $imagePath = 'upload/product_multi_images/' . $imageName;

                // Compress and save the image
                Image::make($img)
                    ->resize(800, null, function ($constraint) {
                        $constraint->aspectRatio();
                        $constraint->upsize();
                    })
                    ->save(public_path($imagePath), 75); // Adjust the quality to compress

                // Save the image info to the database
                $product_multiImage = new MultiImg();
                $product_multiImage->product_id = $product->id;
                $product_multiImage->photo_name = $imageName;
                $product_multiImage->created_at = Carbon::now();
                $product_multiImage->save();
            }
        }

        $product->brands()->attach($validatedData['brand_id']);
        $product->productCategory()->attach($validatedData['product_category_id']);


        // Create Product SubCategory if product_subcategory_id exists
        if (isset($validatedData['product_subcategory_id'])) {
            $subCategoryIds = [];
            foreach ($validatedData['product_subcategory_id'] as $subCategoryId) {
                $productSubCategory = ProductSubCategory::find($subCategoryId);
                if ($productSubCategory) {
                    $subCategoryIds[] = $productSubCategory->id;
                }
            }
            $product->productSubCategory()->attach($subCategoryIds);
        }

        // Store stock information
        $colorNames = $request->input('product_color_id');
        $stockQuantities1 = $request->input('stock_qty_1');
        $stockQuantities2 = $request->input('stock_qty_2');

        foreach ($colorNames as $index => $colorName) {
            // Decode color name
            $colorArray = json_decode($colorName, true);
            $colorName = $colorArray[0]['value'] ?? $colorName;

            // Find or create the color
            $color = ProductColor::firstOrCreate(
                ['color_name' => $colorName],
                ['color_slug' => Str::slug($colorName)]
            );

            // Store stock for branch 1
            Stock::updateOrCreate(
                [
                    'product_id' => $product->id,
                    'brand_id' => 1, // Replace with actual brand id
                    'branch_id' => 1,
                    'product_color_id' => $color->id,
                ],
                ['purchase_qty' => (int)$stockQuantities1[$index] ?? 0, 'sell_qty' => 0]
            );

            // Store stock for branch 2
            Stock::updateOrCreate(
                [
                    'product_id' => $product->id,
                    'brand_id' => 1, // Replace with actual brand id
                    'branch_id' => 2,
                    'product_color_id' => $color->id,
                ],
                ['purchase_qty' => (int)$stockQuantities2[$index] ?? 0, 'sell_qty' => 0]
            );
        }


        $notification = [
            'message' => 'Product created successfully!',
            'alert-type' => 'success',
        ];

        return redirect()->route('all.product')->with($notification);
    }

    public function AdminStoreProduct(Request $request)
    {
        // Validate request
        //dd($request->all());

        $validator = Validator::make($request->all(), [
            'product_code' => 'required|unique:products,product_code|string|max:255',
            'product_name' => 'required|unique:products,product_name|string|max:255',
            'purchase_price' => 'required|string|max:255',
            'selling_price' => 'required|string|max:255',
            'discount_price' => 'required|string|max:255',
            'brand_id' => 'required|string|max:255',
            'product_category_id' => 'required|string|max:255',
            'product_subcategory_id' => 'array',
            'product_subcategory_id.*' => 'integer',
            'product_color_id.*' => 'required|string|max:255',
            'stock_qty_1.*' => 'required|integer|min:0',
            'stock_qty_2.*' => 'required|integer|min:0',
        ]);

        if ($validator->fails()) {
            $notification = [
                'message' => 'Validation failed.',
                'alert-type' => 'error',
            ];
            return redirect()->back()->withErrors($validator)->withInput()->with($notification);
        }

        $validatedData = $validator->validated();

        // Handle file upload


        // Create new product
        $product = new Product();
        $product->product_code = $request->input('product_code');
        $product->product_name = $request->input('product_name');
        $product->product_slug = strtolower(str_replace(' ', '-', $request->product_name));
        $product->user_id = auth()->user()->id;
        $product->product_type_id = 1;
        $product->status = 'inactive';
        $product->created_at = Carbon::now();
        $product->save();

        // Store product Price
        $product_price = new Price();
        $product_price->product_id = $product->id;
        $product_price->purchase_price = $request->input('purchase_price');
        $product_price->selling_price = $request->input('selling_price');
        $product_price->discount_price = $request->input('discount_price');
        $product_price->created_at = Carbon::now();
        $product_price->save();

        $product->brands()->attach($validatedData['brand_id']);
        $product->productCategory()->attach($validatedData['product_category_id']);


        // Create Product SubCategory if product_subcategory_id exists
        if (isset($validatedData['product_subcategory_id'])) {
            $subCategoryIds = [];
            foreach ($validatedData['product_subcategory_id'] as $subCategoryId) {
                $productSubCategory = ProductSubCategory::find($subCategoryId);
                if ($productSubCategory) {
                    $subCategoryIds[] = $productSubCategory->id;
                }
            }
            $product->productSubCategory()->attach($subCategoryIds);
        }

        // Store stock information
        $colorNames = $request->input('product_color_id');
        $stockQuantities1 = $request->input('stock_qty_1');
        $stockQuantities2 = $request->input('stock_qty_2');

        foreach ($colorNames as $index => $colorName) {
            // Decode color name
            $colorArray = json_decode($colorName, true);
            $colorName = $colorArray[0]['value'] ?? $colorName;

            // Find or create the color
            $color = ProductColor::firstOrCreate(
                ['color_name' => $colorName],
                ['color_slug' => Str::slug($colorName)]
            );

            // Store stock for branch 1
            Stock::updateOrCreate(
                [
                    'product_id' => $product->id,
                    'brand_id' => 1, // Replace with actual brand id
                    'branch_id' => 1,
                    'product_color_id' => $color->id,
                ],
                ['purchase_qty' => (int)$stockQuantities1[$index] ?? 0, 'sell_qty' => 0]
            );

            // Store stock for branch 2
            Stock::updateOrCreate(
                [
                    'product_id' => $product->id,
                    'brand_id' => 1, // Replace with actual brand id
                    'branch_id' => 2,
                    'product_color_id' => $color->id,
                ],
                ['purchase_qty' => (int)$stockQuantities2[$index] ?? 0, 'sell_qty' => 0]
            );
        }


        $notification = [
            'message' => 'Admin Product created successfully!',
            'alert-type' => 'success',
        ];

        return redirect()->route('all.product')->with($notification);
    }

    public function updatetestProduct(Request $request)
    {
        $id = $request->id;

        //dd($request->all());

        $validator = Validator::make($request->all(), [
            'product_code' => 'required|string|max:255',
            'product_name' => 'required|string|max:255',
            'short_descp' => 'required|string',
            'long_descp' => 'required|string',
            'product_size' => 'required|string|max:255',
            'purchase_price' => 'required|string|max:255',
            'selling_price' => 'required|string|max:255',
            'discount_price' => 'required|string|max:255',
            'brand_id' => 'required|string|max:255',
            'product_category_id' => 'required|string|max:255',
            'product_subcategory_id' => 'array',
            'product_subcategory_id.*' => 'integer',
            'product_color_id.*' => 'required|string|max:255',
            'stock_qty_1.*' => 'required|integer|min:0',
            'stock_qty_2.*' => 'required|integer|min:0',
        ]);

        if ($validator->fails()) {
            $notification = [
                'message' => 'Validation failed.',
                'alert-type' => 'error',
            ];
            return redirect()->back()->withErrors($validator)->withInput()->with($notification);
        }

        $validatedData = $validator->validated();

        $product = Product::findOrFail($id);
        $product->product_code = $request->input('product_code');
        $product->product_name = $request->input('product_name');
        $product->product_slug = strtolower(str_replace(' ', '-', $request->product_name));
        $product->user_id = auth()->user()->id;
        $product->product_type_id = 1;
        $product->status = 'inactive';
        if ($request->hasFile('product_photo')) {
            $image = $request->file('product_photo');
            $imageName = hexdec(uniqid()) . '.' . $image->getClientOriginalExtension();
            $imagePath = 'upload/product_images/' . $imageName;

            // Compress and save the image
            Image::make($image)
                ->resize(800, null, function ($constraint) {
                    $constraint->aspectRatio();
                    $constraint->upsize();
                })
                ->save(public_path($imagePath), 75);

            $product->product_photo = $imageName;
        }
        $product->updated_at = Carbon::now();
        $product->save();

        $product_info = ProductInfo::where('product_id', $product->id)->first();

        if (!$product_info) {
            $product_info = new ProductInfo();
            $product_info->product_id = $product->id;
        }

        $product_info->short_descp = $request->input('short_descp');
        $product_info->long_descp = $request->input('long_descp');
        $product_info->product_size = $request->input('product_size');
        $product_info->url = $this->convertToEmbedUrl($request->input('url'));
        $product_info->new = $request->input('new');
        $product_info->hot = $request->input('hot');
        $product_info->sale = $request->input('sale');
        $product_info->best_sale = $request->input('best_sale');
        $product_info->updated_at = Carbon::now();

        $product_info->save();

        $product_price = Price::where('product_id', $product->id)->first();
        $product_price->purchase_price = $request->input('purchase_price');
        $product_price->selling_price = $request->input('selling_price');
        $product_price->discount_price = $request->input('discount_price');
        $product_price->updated_at = Carbon::now();
        $product_price->save();

        if ($request->file('multi_img')) {
            // Remove old images
            foreach ($product->multiImages as $img) {
                if (file_exists(public_path('upload/product_multi_images/' . $img->photo_name))) {
                    unlink(public_path('upload/product_multi_images/' . $img->photo_name));
                }
                $img->delete();
            }

            // Upload new images
            foreach ($request->file('multi_img') as $file) {
                $filename = hexdec(uniqid()) . '.' . $file->getClientOriginalExtension();
                $file->move(public_path('upload/product_multi_images'), $filename);

                MultiImg::create([
                    'product_id' => $product->id,
                    'photo_name' => $filename,
                ]);
            }
        }

        // Update Product Brand
        $product->brands()->sync($validatedData['brand_id']);
        $product->productCategory()->sync($validatedData['product_category_id']);

        // Update Product SubCategory if product_subcategory_id exists
        if (isset($validatedData['product_subcategory_id'])) {
            $subCategoryIds = [];
            foreach ($validatedData['product_subcategory_id'] as $subCategoryId) {
                $productSubCategory = ProductSubCategory::find($subCategoryId);
                if ($productSubCategory) {
                    $subCategoryIds[] = $productSubCategory->id;
                }
            }
            $product->productSubCategory()->sync($subCategoryIds);
        }

        $colorIds = $request->input('product_color_id');
        $stockQty1 = $request->input('stock_qty_1');
        $stockQty2 = $request->input('stock_qty_2');

        foreach ($colorIds as $index => $colorId) {
            // Decode color ID if needed
            $colorArray = json_decode($colorId, true);
            if (is_array($colorArray)) {
                $colorName = strtoupper($colorArray[0]['value'] ?? $colorId);

                $color = ProductColor::firstOrCreate(
                    ['color_name' => $colorName],
                    ['color_slug' => Str::slug($colorName)]
                );
                $colorId = $color->id;
            }

            // Update or create stock for branch 1
            Stock::updateOrCreate(
                [
                    'product_id' => $product->id,
                    'product_color_id' => $colorId,
                    'branch_id' => 1,
                ],
                [
                    'purchase_qty' => $stockQty1[$index] ?? 0,
                    'brand_id' => 1,
                ]
            );

            // Update or create stock for branch 2
            Stock::updateOrCreate(
                [
                    'product_id' => $product->id,
                    'product_color_id' => $colorId,
                    'branch_id' => 2,
                ],
                [
                    'purchase_qty' => $stockQty2[$index] ?? 0,
                    'brand_id' => 1,
                ]
            );
        }

        $notification = [
            'message' => 'Product updated successfully!',
            'alert-type' => 'success',
        ];

        return redirect()->route('all.product')->with($notification);
    }

    public function deleteStocksByColor($colorId)
    {
        // Delete all stocks with the given color ID
        DB::transaction(function () use ($colorId) {
            Stock::where('product_color_id', $colorId)->delete();
        });

        return response()->json(['message' => 'Stocks deleted successfully']);
    }










}
