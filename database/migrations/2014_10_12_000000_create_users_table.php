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
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->foreignId('department_id')->nullable();
            $table->foreignId('branche_id')->nullable();
            $table->foreignId('calendar_id')->nullable();
            $table->foreignId('place_id')->nullable();
            $table->string('name');
            $table->string('ci')->unique();
            $table->enum('blood_type',['O+','O-','A+','A-','B+','B-','AB+','AB-',])->default('O+')->nullable();
            $table->enum('drive_license',['A','B','F','A1','C','C1','D','D1','E','E1','G'])->nullable();
            $table->string('email')->unique();
            $table->string('cellphone')->nullable();
            $table->string('phone')->nullable();
            $table->string('address')->nullable();
            $table->string('country')->nullable();
            $table->string('charge')->nullable();
            $table->string('province')->nullable();
            $table->string('city')->nullable();
            $table->dateTime('date_in')->nullable();
            $table->string('enterprise_mail')->nullable();
            $table->string('enterpriser_phone');
            $table->string('enterpriser_phone_ext')->nullable();
            $table->string('avatar_url')->nullable();
            $table->enum('type_user',['fixed','external'])->default('fixed');
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->boolean('status')->default(true);
            $table->rememberToken();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
