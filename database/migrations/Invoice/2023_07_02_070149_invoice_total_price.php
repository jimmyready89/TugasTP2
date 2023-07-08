<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('InvoiceTotalPrice', function (Blueprint $table) {
            $table->bigInteger('invoice_id');
            $table->decimal('total_price', $precision = 38, $scale = 4);
            $table->decimal('discount_percent', $precision = 3, $scale = 3);
            $table->decimal('discount_amount', $precision = 38, $scale = 16);
            $table->decimal('total_price_after_discount', $precision = 38, $scale = 4);
            $table->timestampsTz($precision = 0);
            $table->bigInteger('userupdate_id');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('InvoiceTotalPrice');
    }
};
