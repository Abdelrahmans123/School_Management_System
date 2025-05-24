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
        Schema::create('teachers', function (Blueprint $table) {
            $table->id();
            $table->json('name');
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->date('joiningDate');
            $table->text('address');
            $table->string('zoom_access_token')->nullable();
            $table->string('zoom_refresh_token')->nullable();
            $table->timestamp('zoom_token_expires_in')->nullable();
            $table->unsignedBigInteger('specialization_id');
            $table->unsignedBigInteger('gender_id');
            $table->foreign("specialization_id")->on('specializations')->references('id')->onDelete('cascade');
            $table->foreign("gender_id")->on('genders')->references('id')->onDelete('cascade');
            $table->rememberToken();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('teachers');
    }
};
