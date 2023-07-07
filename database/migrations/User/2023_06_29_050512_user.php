<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('User', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('username', 700);
            $table->string('password', 700);
            $table->string('salt', 300);
            $table->timestampsTz($precision = 0);
            $table->bigInteger('usercreate_id');
            $table->bigInteger('userupdate_id');
            $table->smallInteger('active');
            $table->smallInteger('is_admin');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('User');
    }
};
