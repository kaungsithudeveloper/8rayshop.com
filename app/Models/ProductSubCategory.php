<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use App\Models\ProductCategory;

class ProductSubCategory extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function product_category(){
        return $this->belongsTo(ProductCategory::class, 'product_categories_id');
    }
}
