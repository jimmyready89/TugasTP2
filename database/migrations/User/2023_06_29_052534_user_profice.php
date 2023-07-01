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
        Schema::create('UserProfile', function (Blueprint $table) {
            $table->bigInteger('userid');
            $table->string('real_name', 700);
            $table->string('email', 700);
            $table->primary(['userid']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('UserProfile');
    }
};
