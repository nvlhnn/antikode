<?php

namespace Database\Factories;

use App\Models\Brand;
use Illuminate\Database\Eloquent\Factories\Factory;

class BrandFactory extends Factory
{

    protected $model = Brand::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name' => $this->faker->company,
            'logo' =>  $this->faker->image('public/storage/brands', 100, 100, null, false),
            'banner' =>  $this->faker->image('public/storage/brands', 1000, 300, null, false),
        ];
    }
}
