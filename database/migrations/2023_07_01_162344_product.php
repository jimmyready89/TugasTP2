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
        Schema::create('Product', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('sku', 300);
            $table->string('nama', 700);
            $table->dateTimeTz('created_date', $precision = 0);
            $table->dateTimeTz('update_date', $precision = 0);
            $table->bigInteger('usercreate_id');
            $table->bigInteger('userupdate_id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('Product');
    }
};
