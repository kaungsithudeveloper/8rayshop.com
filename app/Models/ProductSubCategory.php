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

    public function category(){
        return $this->belongsTo(ProductCategory::class, 'product_category_id','id');
    }

    public function products()
    {
        return $this->belongsToMany(Product::class, 'product_category_belongs')
                    ->withPivot('product_category_id')
                    ->withTimestamps();
    }
}
