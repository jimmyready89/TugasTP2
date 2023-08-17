<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        if (!Schema::hasTable('Product')) {
            Schema::create('Product', function (Blueprint $table) {
                $table->bigIncrements('id');
                $table->string('sku', 300);
                $table->string('nama', 700);
                $table->timestampsTz($precision = 0);
                $table->bigInteger('usercreate_id');
                $table->bigInteger('userupdate_id');
            });
        }
    }

    public function down(): void
    {
        Schema::dropIfExists('Product');
    }
};
