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
        Schema::create('calendar_guards', function (Blueprint $table) {
            $table->id();
            $table->foreignId('branche_id');
            $table->enum('type',['12','24'])->defalut('12');
            $table->enum('day',['monday', 'tuesday', 'wednesday', 'thursday', 'friday', 'saturday','sunday']);
            $table->time('time_in');
            $table->time('time_out')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('calendar_guards');
    }
};
