<?php

namespace Tests\Unit;

use Tests\TestCase;
use App\Models\Product\ProductModel;
use App\Models\Product\ProductPriceModel;

class ProductTest extends TestCase
{
    protected static $Product;

    public function test_init_database(): void {
        $this->artisan('migrate', [
            "--path" => "database/migrations/Product"
        ])->assertSuccessful();
    }

    public function test_product_create(): void
    {
        self::$Product = ProductModel::factory()->create();

        $this->assertTrue(self::$Product->id != null);
    }
    
    public function test_product_add_price(): void
    {
        ProductPriceModel::factory()
            ->create(["product_id" => self::$Product->id]);

        $this->assertTrue(self::$Product->Price()->count() == 1);
    }
}
