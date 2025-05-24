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
		Schema::create('guardians', function (Blueprint $table) {
			$table->id();
			$table->string('email')->unique(); // Unique email field
			$table->string('password'); // Hashed password
			$table->rememberToken(); // For "remember me" functionality
			//Fatherinformation
			$table->string('fatherName');
			$table->string('fatherIdNumber');
			$table->string('fatherPassportNumber');
			$table->string('fatherPhone');
			$table->string('fatherJob');
			$table->unsignedBigInteger('fatherNationalityId');
			$table->unsignedBigInteger('fatherBloodTypeId');
			$table->unsignedBigInteger('fatherReligionId');
			$table->string('fatherAddress');
			$table->foreign("fatherNationalityId")->on('nationality')->references('id')->onDelete('cascade');
			$table->foreign("fatherBloodTypeId")->on('blood_types')->references('id')->onDelete('cascade');
			$table->foreign("fatherReligionId")->on('religions')->references('id')->onDelete('cascade');
			//Mother information
			$table->string('motherName');
			$table->string('motherIdNumber');
			$table->string('motherPassportNumber');
			$table->string('motherPhone');
			$table->string('motherJob');
			$table->unsignedBigInteger('motherNationalityId');
			$table->unsignedBigInteger('motherBloodTypeId');
			$table->unsignedBigInteger('motherReligionId');
			$table->string('motherAddress');
			$table->foreign("motherNationalityId")->on('nationality')->references('id')->onDelete('cascade');
			$table->foreign("motherBloodTypeId")->on('blood_types')->references('id')->onDelete('cascade');
			$table->foreign("motherReligionId")->on('religions')->references('id')->onDelete('cascade');
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
		Schema::dropIfExists('guardians');
	}
};
