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
        Schema::create('work_orders', function (Blueprint $table) {
            $table->id();
            $table->foreignId('site_id');
            $table->text('description')->nullable();
            $table->enum('priority', ['high', 'medium', 'low'])->default('medium');
            $table->enum('state', ['started','in_process','completed'])->default('started');
            $table->dateTime('date_time_closed')->nullable();
            $table->text('description_closed')->nullable();
            $table->string('img1_url', 500)->nullable();
            $table->string('img2_url', 500)->nullable();
            $table->string('img3_url', 500)->nullable();
            $table->string('img4_url', 500)->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('work_orders');
    }
};
