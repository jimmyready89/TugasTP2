<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        if (!Schema::hasTable('InvoiceProduct')) {
            Schema::create('InvoiceProduct', function (Blueprint $table) {
                $table->bigIncrements('id');
                $table->string('sku', 300);
                $table->string('nama', 700);
                $table->decimal('price_per_unit', $precision = 38, $scale = 4);
                $table->timestampsTz();
                $table->smallInteger('active');
                $table->bigInteger('userupdate_id');
            });
        }
    }

    public function down(): void
    {
        Schema::dropIfExists('InvoiceProduct');
    }
};
