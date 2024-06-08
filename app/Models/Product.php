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
}
