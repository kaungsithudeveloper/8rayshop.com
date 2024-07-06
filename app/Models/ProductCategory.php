<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use App\Models\Product;

class ProductCategory extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function products()
    {
        return $this->belongsToMany(Product::class, 'product_category_belongs', 'product_category_id', 'product_id');
    }

    public function productSubCategories()
    {
        return $this->belongsToMany(ProductSubCategory::class, 'category_subcategory_belongs', 'product_category_id', 'product_subcategory_id');
    }

    public function subcategories()
    {
        return $this->belongsToMany(ProductSubCategory::class, 'category_subcategory_belongs', 'product_category_id', 'product_subcategory_id');
    }


}



