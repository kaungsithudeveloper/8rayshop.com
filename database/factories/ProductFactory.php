<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Product;
/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Product>
 */
class ProductFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    protected $model = Product::class;

    public function definition()
    {
        return [
            'product_code' => $this->faker->unique()->isbn10,
            'product_name' => $this->faker->words(3, true),
            'product_slug' => $this->faker->slug,
            'product_photo' => null, // You can adjust as needed
            'status' => $this->faker->randomElement(['active', 'inactive']),
            'user_id' => 1, // Example user ID
            'product_type_id' => 1, // Example product type ID
        ];
    }
}
