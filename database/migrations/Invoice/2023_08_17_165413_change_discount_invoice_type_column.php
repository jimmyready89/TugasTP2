<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        if (Schema::hasColumn('InvoiceTotalPrice', 'discount_percent')) {
            Schema::table('InvoiceTotalPrice', function (Blueprint $table) {
                $table->decimal('discount_percent', $precision = 6, $scale = 3)->change();
            });
        }
    }
};
