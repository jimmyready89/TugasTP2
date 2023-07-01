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
        Schema::create('User', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('username', 700);
            $table->string('salt', 300);
            $table->dateTimeTz('created_at', $precision = 0);
            $table->dateTimeTz('update_at', $precision = 0);
            $table->bigInteger('usercreate_id');
            $table->bigInteger('userupdate_id');
            $table->smallInteger('active');
            $table->smallInteger('is_admin');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('User');
    }
};
