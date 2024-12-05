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
		Schema::create('student_answers', function (Blueprint $table) {
			$table->id();

			$table->foreignId('student_id')->references('user_id')->on('students')->cascadeOnDelete();
			$table->foreignId('question_id')->references('id')->on('questions')->cascadeOnDelete();
			$table->foreignId('subject_id')->references('id')->on('subjects');
			$table->enum('answer', ['A', 'B', 'C', 'D', 'E']);

			$table->unique(['question_id', 'student_id']);

			$table->timestamps();
		});
	}

	/**
	 * Reverse the migrations.
	 */
	public function down() : void
	{
		Schema::dropIfExists('student_answers');
	}
};
