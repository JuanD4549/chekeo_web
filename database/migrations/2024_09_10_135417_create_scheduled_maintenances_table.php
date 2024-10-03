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
        Schema::create('scheduled_maintenances', function (Blueprint $table) {
            $table->id();
            $table->boolean('active')->default(true);
            $table->json('in_day_time');
            $table->json('days')->nullable();
            $table->json('months')->nullable();
            $table->boolean('for_days')->default(true);
            $table->json('days_num')->nullable();
            $table->json('the')->nullable();
            $table->foreignId('site_id');
            $table->text('description')->nullable();
            $table->enum('priority', ['high', 'medium', 'low'])->default('medium');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('scheduled_maintenances');
    }
};
