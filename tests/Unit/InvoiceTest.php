<?php

namespace Tests\Unit;

use Tests\TestCase;
use App\Models\Invoice\InvoiceModel;
use App\Models\Invoice\InvoiceProductModel;

class InvoiceTest extends TestCase
{
    protected static $Invoice;

    public function test_init_database(): void {
        $this->artisan('migrate', [
            '--path' => 'database/migrations/Invoice',
        ])->assertSuccessful();
    }

    public function test_invoice_create(): void
    {
        self::$Invoice = InvoiceModel::factory()->create();
    
        $this->assertTrue(self::$Invoice->id != null);
    }

    public function test_invoice_add_product() : void
    {
        InvoiceProductModel::factory()->create([
            'invoice_id' => self::$Invoice->id,
        ]);

        $this->assertTrue(self::$Invoice->ProductList()->count() == 1);
    }

    public function test_invoice_update_total_price() : void
    {
        self::$Invoice->UpdateTotalPrice(1);

        $PriceTotal = 0;
        $TotalPriceFormInvoiceTable = self::$Invoice->InvoiceTotalPrice->total_price_after_discount;

        $InvoiceProductList = self::$Invoice->ProductList;

        foreach($InvoiceProductList as $InvoiceProduct){
            $PriceTotal += $InvoiceProduct->price_per_unit * $InvoiceProduct->count;
        }

        $this->assertTrue($TotalPriceFormInvoiceTable == $PriceTotal && $PriceTotal != 0);
    }

    public function test_invoice_remove_product() : void
    {
        self::$Invoice->ProductList[0]->delete();

        $this->assertTrue(self::$Invoice->ProductList()->count() == 0);
    }
}
