<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('libraries', function (Blueprint $table) {
			$table->id();
			$table->string('book_name');
			$table->string('file_name');
			$table->foreignId('stage_id')->references('id')->on('stages')->onDelete('cascade');
			$table->foreignId('grade_id')->references('id')->on('grades')->onDelete('cascade');
			$table->foreignId('section_id')->references('id')->on('sections')->onDelete('cascade');
			$table->foreignId('teacher_id')->references('id')->on('teachers')->onDelete('cascade');
			$table->timestamps();
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::dropIfExists('libraries');
	}
};
