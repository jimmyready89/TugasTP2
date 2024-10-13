<?php

namespace Database\Factories\Product;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Product\ProductPriceModel;

class ProductPriceModelFactory extends Factory
{
    protected $model = ProductPriceModel::class;

    public function definition(): array
    {
        return [
            "price_per_unit" => fake()->numberBetween(1500, 6000),
            "valid_date" => fake()->date(),
            "usercreate_id" => 0,
            "userupdate_id" => 0
        ];
    }
}
