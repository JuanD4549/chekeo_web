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
        Schema::create('guard_reliefs', function (Blueprint $table) {
            $table->id();
            $table->foreignId('place_id');
            $table->foreignId('user_id');
            $table->foreignId('turn_in_id');
            $table->foreignId('turn_out_id');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('guard_reliefs');
    }
};
