<?php

namespace Database\Factories;

use App\Models\Product;
use Illuminate\Database\Eloquent\Factories\Factory;

class ProductFactory extends Factory
{
    protected $model = Product::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'brand_id' => 1,
            'name' => $this->faker->word,
            'picture' => $this->faker->image('public/storage/products', 100, 100, null, false),
            'price' => $this->faker->randomNumber(5),
        ];
    }
}
