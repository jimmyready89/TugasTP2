<?php

namespace Database\Factories\Product;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Product\ProductModel;

class ProductModelFactory extends Factory
{
    protected $model = ProductModel::class;

    public function definition(): array
    {
        return [
            "sku" => fake()->name(),
            "nama" => fake()->name(),
            "usercreate_id" => 0,
            "userupdate_id" => 0
        ];
    }
}
