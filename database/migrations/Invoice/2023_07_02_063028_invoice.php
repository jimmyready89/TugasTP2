<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('Invoice', function (Blueprint $table) {
            $table->bigIncrements('Id');
            $table->string('no_invoice', 700);
            $table->string('customer_name', 700);
            $table->date('date');
            $table->timestampsTz($precision = 0);
            $table->bigInteger('usercreate_id');
            $table->bigInteger('userupdate_id');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('Invoice');
    }
};
