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
        Schema::create('registration_visits', function (Blueprint $table) {
            $table->id();
            $table->foreignId('employee_id');
            $table->foreignId('branche_id');
            $table->foreignId('visit_id');
            $table->foreignId('visit_car_id')->nullable();
            $table->dateTime('date_time_in');
            $table->dateTime('date_time_out')->nullable();
            $table->string('img1_url')->nullable();
            $table->string('img2_url')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('registration_visits');
    }
};
