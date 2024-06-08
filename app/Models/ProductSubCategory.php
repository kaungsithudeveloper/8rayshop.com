<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use App\Models\ProductCategory;
use App\Models\Product;

class ProductSubCategory extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function product_category(){
        return $this->belongsTo(ProductCategory::class, 'product_categories_id');
    }

    public function products()
    {
        return $this->hasMany(Product::class);
    }
}
