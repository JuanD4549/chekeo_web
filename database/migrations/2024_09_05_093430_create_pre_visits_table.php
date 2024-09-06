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
        Schema::create('pre_visits', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id');
            $table->foreignId('visit_id');
            $table->dateTime('date_time_in');
            $table->double('status')->default(false);
            $table->integer('pin')->unique();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pre_visits');
    }
};
