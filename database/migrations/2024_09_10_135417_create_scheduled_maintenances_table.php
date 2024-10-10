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
            $table->array('in_day_time');
            $table->array('days')->nullable();
            $table->array('months')->nullable();
            $table->boolean('for_days')->default(true);
            $table->array('days_num')->nullable();
            $table->array('the')->nullable();
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
