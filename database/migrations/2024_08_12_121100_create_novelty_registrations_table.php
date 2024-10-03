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
        Schema::create('novelty_registrations', function (Blueprint $table) {
            $table->id();
            $table->foreignId('branche_id');
            $table->foreignId('security_guard_id');
            $table->foreignId('employee_id');
            $table->foreignId('novelty_id');
            $table->text('detail_created')->nullable();
            $table->dateTime('date_time_close')->nullable();
            $table->text('detail_closed')->nullable();
            $table->double('latitude');
            $table->double('longitude');
            $table->string('img1_url')->nullable();
            $table->string('img2_url')->nullable();
            $table->string('img3_url')->nullable();
            $table->string('img4_url')->nullable();
            $table->string('fill_url')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('novelty_registrations');
    }
};
