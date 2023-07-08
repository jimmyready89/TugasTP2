<?php

namespace Database\Factories\Invoice;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use App\Models\Invoice\InvoiceProductModel;

class InvoiceProductModelFactory extends Factory
{
    protected $model = InvoiceProductModel::class;

    public function definition(): array
    {
        return [
            "sku" => fake()->randomNumber(),
            "nama" => fake()->name,
            "price_per_unit" => fake()->randomDigit(),
            "userupdate_id" => 0
        ];
    }
}
