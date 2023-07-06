<?php

namespace Database\Factories\Product;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use App\Models\Product\ProductPriceModel;

class ProductPriceModelFactory extends Factory
{
    protected $model = ProductPriceModel::class;

    public function definition(): array
    {
        return [
            "price_per_unit" => fake()->randomDigit(),
            "valid_date" => fake()->date(),
            "usercreate_id" => 0,
            "userupdate_id" => 0
        ];
    }
}
