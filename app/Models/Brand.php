<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Brand extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function products()
    {
        return $this->belongsToMany(Product::class, 'product_brand_belongs', 'brand_id', 'product_id');
    }

    public function stocks()
    {
        return $this->hasMany(Stock::class);
    }

    public function calculateProfitLoss()
    {
        $totalProfit = 0;
        $totalLoss = 0;

        foreach ($this->products as $product) {
            $result = $product->calculateProfitLoss();
            $totalProfit += $result['profit'];
            $totalLoss += $result['loss'];
        }

        return [
            'profit' => $totalProfit,
            'loss' => $totalLoss,
        ];
    }
}
