<?php

namespace Tests\Unit;

use Tests\TestCase;
use App\Models\Product\ProductModel;
use App\Models\Product\ProductPriceModel;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Str;

class ProductTest extends TestCase
{
    protected static $Product;

    public function test_product_create(): void
    {
        $this->artisan('migrate', [
            "--path" => "database/migrations/Product"
        ]);

        $Product = ProductModel::factory()->create();
        $ProductPrice = ProductPriceModel::factory()
            ->create(["product_id" => $Product->id]);
        
        $this->assertTrue(true);
    }
}
