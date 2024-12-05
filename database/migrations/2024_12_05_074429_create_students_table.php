<?php

declare(strict_types=1);

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
			$table->foreignID('user_id')->primary()->references('id')->on('users')->cascadeOnDelete();

			$table->string('external_id')->index();
			$table->string('full_name');
			$table->string('image')->nullable();

			$table->foreignID('major_id')->references('id')->on('majors');
			$table->foreignID('classroom_id')->references('id')->on('classroom');

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
