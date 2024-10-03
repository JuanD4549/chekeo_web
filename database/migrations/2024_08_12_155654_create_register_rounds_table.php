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
        Schema::create('register_rounds', function (Blueprint $table) {
            $table->id();
            $table->foreignId('branche_id');
            $table->foreignId('place_id');
            $table->foreignId('security_guard_id');
            $table->dateTime('date_time_closed')->nullable();
            $table->text('detail_close')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('register_rounds');
    }
};
