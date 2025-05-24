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
        Schema::create('promotions', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('student_id');
            $table->unsignedBigInteger('fromGrade');
            $table->unsignedBigInteger('fromStage');
            $table->unsignedBigInteger('fromSection');
            $table->string('oldAcademicYear');
            $table->unsignedBigInteger('toGrade');
            $table->unsignedBigInteger('toStage');
            $table->unsignedBigInteger('toSection');
            $table->string('academicYear');
            $table->foreign('student_id')->references('id')->on('students')->onDelete('cascade');
            $table->foreign('fromStage')->references('id')->on('stages')->onDelete('cascade');
            $table->foreign('fromGrade')->references('id')->on('grades')->onDelete('cascade');
            $table->foreign('fromSection')->references('id')->on('sections')->onDelete('cascade');
            $table->foreign('toStage')->references('id')->on('stages')->onDelete('cascade');
            $table->foreign('toGrade')->references('id')->on('grades')->onDelete('cascade');
            $table->foreign('toSection')->references('id')->on('sections')->onDelete('cascade');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('promotions');
    }
};
