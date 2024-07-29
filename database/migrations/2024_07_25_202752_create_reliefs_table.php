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
        Schema::create('reliefs', function (Blueprint $table) {
            $table->id();
            $table->foreignId('branche_id');
            $table->foreignId('relief_in_id');
            $table->foreignId('relief_out_id');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('reliefs');
    }
};
