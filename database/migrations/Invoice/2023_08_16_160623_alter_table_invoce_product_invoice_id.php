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
        if (!Schema::hasColumn('InvoiceProduct', 'invoice_id')) {
            Schema::table('InvoiceProduct', function (Blueprint $table) {
                $table->bigInteger('invoice_id')->nullable();
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('InvoiceProduct', function (Blueprint $table) {
            $table->dropColumn('invoice_id');
        });
    }
};
