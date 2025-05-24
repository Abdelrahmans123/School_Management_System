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
        Schema::create('sessions', function (Blueprint $table) {
            $table->id();
            $table->boolean('is_integrated');
            $table->string('meeting_id')->nullable();
            $table->string('topic')->nullable();
            $table->dateTime('start_at')->nullable();
            $table->integer('duration')->nullable();
            $table->string('password')->nullable();
            $table->text('start_url')->nullable();
            $table->text('join_url')->nullable();
            $table->string('created_by');
            $table->foreignId('stage_id')->references('id')->on('stages')->onDelete('cascade');
            $table->foreignId('grade_id')->references('id')->on('grades')->onDelete('cascade');
            $table->foreignId('section_id')->references('id')->on('sections')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sessions');
    }
};
