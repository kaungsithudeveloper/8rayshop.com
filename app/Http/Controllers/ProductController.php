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
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Validator;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;


class ProductController extends Controller
{
    public function AllProduct(){
        $products = Product::latest()->get();
        return view('backend.admin.product.product_all',compact('products'));
    } // End Method

    public function AddProduct(){

        $product_type = ProductType::orderBy('product_type_name','ASC')->get();
        $brands = Brand::orderBy('brand_name','ASC')->get();
        $product_categories = ProductCategory::orderBy('product_category_name','ASC')->get();
        $product_subCategories = ProductSubCategory::orderBy('product_subcategory_name','ASC')->get();
        return view('backend.admin.product.product_add',compact('product_type','brands','product_categories','product_subCategories'));

    } // End Method

    public function StoreProduct(Request $request)
    {
        // Validate the request data
        //dd($request->all());
        $validator = Validator::make($request->all(), [
            'product_code' => 'required|unique:products,product_code|string|max:255',
            'product_name' => 'required|unique:products,product_name|string|max:255',
            'short_descp' => 'required|string',
            'long_descp' => 'required|string',
            'product_qty' => 'required|integer',
            'product_size' => 'required|string|max:255',
            'purchase_price' => 'required|string|max:255',
            'selling_price' => 'required|string|max:255',
            'discount_price' => 'required|string|max:255',
            'brand_id' => 'required|string|max:255',
            'product_color_id' => 'required|string|max:255',
            'product_category_id' => 'required|string|max:255',
            'product_subcategory_id' => 'array',
            'product_subcategory_id.*' => 'integer',

        ]);



        if ($validator->fails()) {
            $notification = [
                'message' => 'Validation failed.',
                'alert-type' => 'error',
            ];
            return redirect()->back()->withErrors($validator)->withInput()->with($notification);
        }

        $validatedData = $validator->validated();

        // Create the product
        $product = new Product();
        $product->product_code = $request->input('product_code');
        $product->product_name = $request->input('product_name');
        $product->product_slug = strtolower(str_replace(' ', '-', $request->product_name));
        $product->product_qty = $request->input('product_qty');
        $product->purchase_price = $request->input('purchase_price');
        $product->selling_price = $request->input('selling_price');
        $product->discount_price = $request->input('discount_price');
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

        $product_info = new ProductInfo();
        $product_info->product_id = $product->id;
        $product_info->short_descp = $request->input('short_descp');
        $product_info->long_descp = $request->input('long_descp');
        $product_info->product_size = $request->input('product_size');
        $product_info->new = $request->input('new');
        $product_info->hot = $request->input('hot');
        $product_info->sale = $request->input('sale');
        $product_info->best_sale = $request->input('best_sale');
        $product_info->created_at = Carbon::now();
        $product_info->save();


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

        // Create Product Color
        $product_colors = explode(',', $validatedData['product_color_id']);
        $colorIds = [];
        foreach ($product_colors as $color_name) {
            $color_name = trim($color_name);
            $productColor = ProductColor::firstOrCreate(
                ['color_name' => $color_name],
                ['color_slug' => Str::slug($color_name)]
            );
            $colorIds[] = $productColor->id;
        }
        $product->productColor()->attach($colorIds);


         // Create Product Brand
        $brands = explode(',', $validatedData['brand_id']);
        $brandIds = [];
        foreach ($brands as $brand_name) {
            $brand_name = trim($brand_name);
            $brand = Brand::firstOrCreate(
                ['brand_name' => $brand_name],
                ['brand_slug' => Str::slug($brand_name)]
            );
            $brandIds[] = $brand->id;
        }
        $product->brands()->attach($brandIds);



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


        $notification = [
            'message' => 'Product created successfully!',
            'alert-type' => 'success',
        ];

        return redirect()->route('all.product')->with($notification);
    }

    public function EditProduct($slug)
    {
        // Retrieve the product by slug
        $product = Product::with(['productInfo', 'productColor', 'brands', 'categories', 'productSubCategory', 'multiImages'])
    ->where('product_slug', $slug)
    ->firstOrFail();

        // Retrieve all necessary related data
        $product_type = ProductType::orderBy('product_type_name', 'ASC')->get();
        $brands = Brand::orderBy('brand_name', 'ASC')->get();
        $product_categories = ProductCategory::orderBy('product_category_name', 'ASC')->get();
        $product_subCategories = ProductSubCategory::orderBy('product_subcategory_name', 'ASC')->get();

        // Pass the data to the view
        return view('backend.admin.product.product_edit', compact('product', 'product_type', 'brands', 'product_categories', 'product_subCategories'));
    }

    public function UpdateProduct(Request $request)
    {
        //dd($request->all());
        $id = $request->id;
        // Validate the request data
        $validator = Validator::make($request->all(), [
            'product_code' => 'required|string|max:255' . $id,
            'product_name' => 'required|string|max:255' . $id,
            'short_descp' => 'required|string',
            'long_descp' => 'required|string',
            'product_qty' => 'required',
            'product_size' => 'required|string|max:255',
            'purchase_price' => 'required|string|max:255',
            'selling_price' => 'required|string|max:255',
            'discount_price' => 'required|string|max:255',
            'brand_id' => 'required|string|max:255',
            'product_color_id' => 'required|string|max:255',
            'product_category_id' => 'required|string|max:255',
            'product_subcategory_id' => 'array',
            'product_subcategory_id.*' => 'integer',
        ]);

        if ($validator->fails()) {
            $notification = [
                'message' => 'Validation failed.',
                'alert-type' => 'error',
            ];
            return redirect()->back()->withErrors($validator)->withInput()->with($notification);
        }

        $validatedData = $validator->validated();

        // Find the product
        $product = Product::findOrFail($id);
        $product->product_code = $request->input('product_code');
        $product->product_name = $request->input('product_name');
        $product->product_slug = strtolower(str_replace(' ', '-', $request->product_name));
        $product->product_qty = $request->input('product_qty');
        $product->purchase_price = $request->input('purchase_price');
        $product->selling_price = $request->input('selling_price');
        $product->discount_price = $request->input('discount_price');
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
        $product_info->short_descp = $request->input('short_descp');
        $product_info->long_descp = $request->input('long_descp');
        $product_info->product_size = $request->input('product_size');
        $product_info->new = $request->input('new');
        $product_info->hot = $request->input('hot');
        $product_info->sale = $request->input('sale');
        $product_info->best_sale = $request->input('best_sale');
        $product_info->updated_at = Carbon::now();
        $product_info->save();

        if ($request->file('multi_img')) {
            // Remove old images
            foreach ($product->multiImages as $img) {
                if (file_exists(public_path('upload/product_multi_images/'.$img->photo_name))) {
                    unlink(public_path('upload/product_multi_images/'.$img->photo_name));
                }
                $img->delete();
            }

            // Upload new images
            foreach ($request->file('multi_img') as $file) {
                $filename = hexdec(uniqid()).'.'.$file->getClientOriginalExtension();
                $file->move(public_path('upload/product_multi_images'), $filename);

                MultiImg::create([
                    'product_id' => $product->id,
                    'photo_name' => $filename,
                ]);
            }
        }

        // Update Product Color
        $product_colors = explode(',', $validatedData['product_color_id']);
        $colorIds = [];
        foreach ($product_colors as $color_name) {
            $color_name = trim($color_name);
            $productColor = ProductColor::firstOrCreate(
                ['color_name' => $color_name],
                ['color_slug' => Str::slug($color_name)]
            );
            $colorIds[] = $productColor->id;
        }
        $product->productColor()->sync($colorIds);

        // Update Product Brand
        $brands = explode(',', $validatedData['brand_id']);
        $brandIds = [];
        foreach ($brands as $brand_name) {
            $brand_name = trim($brand_name);
            $brand = Brand::firstOrCreate(
                ['brand_name' => $brand_name],
                ['brand_slug' => Str::slug($brand_name)]
            );
            $brandIds[] = $brand->id;
        }
        $product->brands()->sync($brandIds);

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

        $notification = [
            'message' => 'Product updated successfully!',
            'alert-type' => 'success',
        ];

        return redirect()->route('all.product')->with($notification);
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

}
