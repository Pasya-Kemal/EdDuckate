<?php

declare(strict_types=1);

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
	/**
	 * Run the migrations.
	 */
	public function up() : void
	{
		Schema::create('scores', function (Blueprint $table) {
			$table->foreignId('student_id')->references('user_id')->on('students')->cascadeOnDelete();
			$table->foreignId('subject_id')->references('id')->on('subjects')->cascadeOnDelete();
            $table->dateTime('submitted_at')->nullable();
			$table->integer('score');

			$table->timestamps();
		});
	}

	/**
	 * Reverse the migrations.
	 */
	public function down() : void
	{
		Schema::dropIfExists('scores');
	}
};
