<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        if (!Schema::hasTable('InvoiceProductList')) {
            Schema::create('InvoiceProductList', function (Blueprint $table) {
                $table->bigIncrements('id');
                $table->bigInteger('invoice_id');
                $table->bigInteger('invoice_product_id');
                $table->timestampsTz($precision = 0);
                $table->bigInteger('userupdate_id');
            });
        }
    }

    public function down(): void
    {
        Schema::dropIfExists('InvoiceProductList');
    }
};
