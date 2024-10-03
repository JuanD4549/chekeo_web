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
        Schema::create('security_guard_shifts', function (Blueprint $table) {
            $table->id();
            $table->foreignId('security_guard_id');
            $table->foreignId('branche_id');
            $table->foreignId('place_id');
            $table->foreignId('detail_in_id')->nullable();
            $table->foreignId('detail_out_id')->nullable();
            $table->boolean('status')->default(true);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('security_guard_shifts');
    }
};
