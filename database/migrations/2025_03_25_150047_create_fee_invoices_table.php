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
        Schema::create('fee_invoices', function (Blueprint $table) {
            $table->id();
            $table->date('date');
            $table->decimal('amount', 8, 2);
            $table->string('description')->nullable();
            $table->foreignId('student_id')->references('id')->on('students')->onDelete('cascade');
            $table->foreignId('stage_id')->references('id')->on('stages')->onDelete('cascade');
            $table->foreignId('grade_id')->references('id')->on('grades')->onDelete('cascade');
            $table->foreignId('fee_id')->references('id')->on('fees')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('fee_invoices');
    }
};
