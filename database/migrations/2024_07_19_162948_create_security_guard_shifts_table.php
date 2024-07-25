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
            $table->foreignId('user_id');
            $table->dateTime('date_time_in');
            $table->dateTime('date_time_out')->nullable();
            $table->enum('turn', ['morning', 'evening', 'night']);
            $table->enum('type', ['12', '24']);
            $table->text('detail_in')->nullable();
            $table->text('detail_out')->nullable();
            $table->double('latitude_in');
            $table->double('longitude_in');
            $table->double('latitude_out');
            $table->double('longitude_out');
            $table->string('img1_url_in');
            $table->string('img2_url_in')->nullable();
            $table->string('img1_url_out');
            $table->string('img2_url_out')->nullable();
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
