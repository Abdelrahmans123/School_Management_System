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
		Schema::create('fees', function (Blueprint $table) {
			$table->id();
			$table->string('title');
			$table->decimal('amount', 8, 2);
			$table->foreignId('stage_id')->references('id')->on('stages')->onDelete('cascade');
			$table->foreignId('grade_id')->references('id')->on('grades')->onDelete('cascade');
			$table->string('description')->nullable();
			$table->string('year');
			$table->integer('type');
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
		Schema::dropIfExists('fees');
	}
};
