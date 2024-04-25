<?php

namespace Database\Factories;

use App\Models\Product;
use Illuminate\Database\Eloquent\Factories\Factory;

class ProductFactory extends Factory
{
    protected $model = Product::class; // Specify the associated model

    public function definition()
    {
        return [
            'product_name' => $this->faker->word,
            'description' => $this->faker->sentence,
            'price' => $this->faker->randomFloat(2, 10, 100), // Random price between 10 and 100
            'stock_s' => $this->faker->numberBetween(10, 100), // Stock for size S
            'stock_m' => $this->faker->numberBetween(10, 100), // Stock for size M
            'stock_l' => $this->faker->numberBetween(10, 100), // Stock for size L
            'stock_xl' => $this->faker->numberBetween(10, 100), // Stock for size XL
        ];
    }
}
