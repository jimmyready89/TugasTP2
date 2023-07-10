<?php

namespace Database\Factories\Invoice;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use App\Models\Invoice\InvoiceProductListModel;

class InvoiceProductListModelFactory extends Factory
{
    protected $model = InvoiceProductListModel::class;

    public function definition(): array
    {
        return [
            "invoice_id" => fake()->randomDigit(),
            "invoice_product_id" => fake()->randomDigit(),
            "userupdate_id" => 0
        ];
    }
}
