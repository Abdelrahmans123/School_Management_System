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
		Schema::create('students', function (Blueprint $table) {
			$table->id();
			$table->string('name');
			$table->string('email')->unique();
			$table->string('password');
			$table->date('birthDate');
			$table->string('academicYear');
			$table->unsignedBigInteger('gender_id');
			$table->unsignedBigInteger('nationality_id');
			$table->unsignedBigInteger('bloodType_id');
			$table->unsignedBigInteger('stage_id');
			$table->unsignedBigInteger('grade_id');
			$table->unsignedBigInteger('section_id');
			$table->unsignedBigInteger('parent_id');
			$table->softDeletes();
			$table->foreign('gender_id')->references('id')->on('genders')->onDelete('cascade');
			$table->foreign('nationality_id')->references('id')->on('nationality')->onDelete('cascade');
			$table->foreign('bloodType_id')->references('id')->on('blood_types')->onDelete('cascade');
			$table->foreign('stage_id')->references('id')->on('stages')->onDelete('cascade');
			$table->foreign('grade_id')->references('id')->on('grades')->onDelete('cascade');
			$table->foreign('section_id')->references('id')->on('sections')->onDelete('cascade');
			$table->foreign('parent_id')->references('id')->on('guardians')->onDelete('cascade');
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
		Schema::dropIfExists('students');
	}
};
