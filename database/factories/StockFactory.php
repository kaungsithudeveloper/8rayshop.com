<?php

namespace Database\Factories;

use App\Models\Stock;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Stock>
 */
class StockFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */

     protected $model = Stock::class;
    public function definition(): array
    {
        return [
            'stock_qty' => $this->faker->numberBetween(0, 200), // Adjust as needed
            // Add more fields if required
        ];
    }
}
