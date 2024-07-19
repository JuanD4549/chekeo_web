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
        Schema::create('register_reliefs', function (Blueprint $table) {
            $table->id();
            $table->foreignId('relief_id');
            $table->foreignId('user_id');
            $table->dateTime('date_time');
            $table->enum('status', ['ingress', 'egress']);
            $table->enum('turn', ['morning', 'evening ', 'night ']);
            $table->text('detail')->nullable();
            $table->double('latitude');
            $table->double('longitude');
            $table->string('img1_url');
            $table->string('img2_url')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('register_reliefs');
    }
};
