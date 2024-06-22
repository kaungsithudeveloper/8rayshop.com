<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use App\Models\ProductType;
use App\Models\ProductInfo;
use App\Models\ProductCategory;
use App\Models\ProductSubCategory;
use App\Models\ProductColor;
use App\Models\Brand;
use App\Models\MultiImg;

class Product extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function productType()
    {
        return $this->belongsTo(ProductType::class);
    }

    public function productInfo()
    {
        return $this->hasOne(ProductInfo::class);
    }

    public function categories()
    {
        return $this->belongsToMany(ProductCategory::class, 'product_category_belongs', 'product_id', 'product_category_id');
    }

    public function productCategory()
    {
        return $this->belongsToMany(ProductCategory::class, 'product_category_belongs', 'product_id', 'product_category_id');
    }



    public function productSubCategory()
    {
        return $this->belongsToMany(ProductSubCategory::class, 'product_subcategory_belongs', 'product_id', 'product_subcategory_id');
    }

    public function productColor()
    {
        return $this->belongsToMany(ProductColor::class, 'product_color_belongs', 'product_id', 'product_color_id');
    }

    public function brands()
    {
        return $this->belongsToMany(Brand::class, 'product_brand_belongs', 'product_id', 'brand_id');
    }

    public function multiImages()
    {
        return $this->hasMany(MultiImg::class, 'product_id');
    }

    public function stock()
    {
        return $this->hasOne(Stock::class, 'product_id');
    }
}
