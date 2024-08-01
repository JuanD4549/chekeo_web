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
        Schema::create('details', function (Blueprint $table) {
            $table->id();
            //$table->enum('turn', ['morning', 'evening', 'night']);
            $table->enum('type', ['in', 'out'])->default('in');
            $table->dateTime('date_time');
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
        Schema::dropIfExists('details');
    }
};
