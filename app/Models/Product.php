<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use App\Models\ProductType;
use App\Models\ProductInfo;

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
}
