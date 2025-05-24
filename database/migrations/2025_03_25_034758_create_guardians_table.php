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
        Schema::create('guardians', function (Blueprint $table) {
            $table->id();
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->json('fatherName');
            $table->string('fatherIdNumber');
            $table->string('fatherPassportNumber');
            $table->string('fatherPhone');
            $table->string('fatherJob');
            $table->unsignedBigInteger('fatherNationalityId');
            $table->unsignedBigInteger('fatherBloodTypeId');
            $table->unsignedBigInteger('fatherReligionId');
            $table->string('fatherAddress');
            $table->foreign("fatherNationalityId")->on('nationalities')->references('id')->onDelete('cascade');
            $table->foreign("fatherBloodTypeId")->on('blood_types')->references('id')->onDelete('cascade');
            $table->foreign("fatherReligionId")->on('religions')->references('id')->onDelete('cascade');
            //Mother information
            $table->json('motherName');
            $table->string('motherIdNumber');
            $table->string('motherPassportNumber');
            $table->string('motherPhone');
            $table->string('motherJob');
            $table->unsignedBigInteger('motherNationalityId');
            $table->unsignedBigInteger('motherBloodTypeId');
            $table->unsignedBigInteger('motherReligionId');
            $table->string('motherAddress');
            $table->foreign("motherNationalityId")->on('nationalities')->references('id')->onDelete('cascade');
            $table->foreign("motherBloodTypeId")->on('blood_types')->references('id')->onDelete('cascade');
            $table->foreign("motherReligionId")->on('religions')->references('id')->onDelete('cascade');
            $table->rememberToken();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('guardians');
    }
};
