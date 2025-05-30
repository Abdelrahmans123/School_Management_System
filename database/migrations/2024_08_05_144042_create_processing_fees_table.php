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
		Schema::create('processing_fees', function (Blueprint $table) {
			$table->id();
			$table->date('date');
			$table->foreignId('student_id')->references('id')->on('students')->onDelete('cascade');
			$table->decimal('amount', 8, 2)->nullable();
			$table->string('description');
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
		Schema::dropIfExists('processing_fees');
	}
};
