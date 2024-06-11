<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use App\Models\ProductType;
use App\Models\ProductInfo;
use App\Models\ProductCategory;
use App\Models\ProductSubCategory;

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

    public function productCategory()
    {
        return $this->belongsTo(ProductCategory::class);
    }

    public function productSubCategory()
    {
        return $this->belongsTo(ProductSubCategory::class);
    }

    public function productColor()
    {
        return $this->belongsToMany(ProductColor::class, 'product_color_belongs', 'product_id', 'product_color_id');
    }

    public function brands()
    {
        return $this->belongsToMany(Brand::class, 'product_brand_belongs', 'product_id', 'brand_id');
    }
}
