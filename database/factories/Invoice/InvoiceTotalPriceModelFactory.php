<?php

namespace Database\Factories\Invoice;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use App\Models\Invoice\InvoiceTotalPriceModel;

class InvoiceTotalPriceModelFactory extends Factory
{
    protected $model = InvoiceTotalPriceModel::class;
    
    public function definition(): array
    {
        return [
            "total_price" => fake()->randomFloat(4, 100, 1000), // Angka acak antara 100 hingga 1000 dengan 4 desimal
            "discount_percent" => fake()->randomFloat(3, 0, 1), // Persentase diskon acak antara 0 hingga 1 dengan 3 desimal
            "discount_amount" => fake()->randomFloat(16, 0, 100), // Jumlah diskon acak antara 0 hingga 100 dengan 16 desimal
            "total_price_after_discount" => fake()->randomFloat(4, 50, 1000), // Total harga setelah diskon acak antara 50 hingga 1000 dengan 4 desimal
            "userupdate_id" => 0
        ];
    }
}
