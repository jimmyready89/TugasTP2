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
        Schema::create('ProductPrice', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('product_id');
            $table->decimal('price_per_unit', $precision = 38, $scale = 4);
            $table->date('valid_date');
            $table->date('create_date');
            $table->date('update_date');
            $table->bigInteger('usercreate_id');
            $table->bigInteger('userupdate_id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ProductPrice');
    }
};
