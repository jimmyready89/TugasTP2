<?php

namespace Database\Factories\Invoice;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use App\Models\Invoice\InvoiceModel;

class InvoiceModelFactory extends Factory
{
    protected $model = InvoiceModel::class;

    public function definition(): array
    {
        return [
            "no_invoice" => fake()->randomDigit(),
            "customer_name" => fake()->name,
            "date" => fake()->date(),
            "usercreate_id" => 0,
            "userupdate_id" => 0
        ];
    }
}
