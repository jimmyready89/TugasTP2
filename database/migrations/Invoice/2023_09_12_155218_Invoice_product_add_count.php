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
        if (!Schema::hasColumn('InvoiceProduct', 'count')) {
            Schema::table('InvoiceProduct', function (Blueprint $table) {
                $table->bigInteger('count')->default(1);
            });
        }
    }
    
    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        if (!Schema::hasColumn('InvoiceProduct', 'count')) {
            Schema::table('InvoiceProduct', function (Blueprint $table) {
                $table->dropColumn('count');
            });
        }
    }
};
