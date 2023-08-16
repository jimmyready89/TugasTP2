<?php

namespace Tests\Unit;

use Tests\TestCase;
use App\Models\Invoice\InvoiceModel;
use App\Models\Invoice\InvoiceProductModel;
use App\Models\Invoice\InvoiceTotalPriceModel;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Factories\Sequence;

class InvoiceTest extends TestCase
{
    protected static $Invoice;
    protected static $InvoiceProduct;
    protected static $InvoiceProductList;
    protected static $InvoiceTotalPrice;

    public function test_invoice_create(): void
    {
        $this->artisan('migrate', [
            '--path' => 'database/migrations/Invoice',
        ]);
    
        $Invoice = InvoiceModel::factory()->create();
    
        InvoiceProductModel::factory()->create([
            'invoice_id' => $Invoice->id,
        ]);

        InvoiceTotalPriceModel::factory()->create([
            'invoice_id' => $Invoice->id,
        ]);
    
        $this->assertTrue(true);
    }
}
