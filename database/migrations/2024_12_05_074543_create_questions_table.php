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
		Schema::create('questions', function (Blueprint $table) {
			$table->id();

			$table->foreignId('subject_id')->references('id')->on('subjects')->cascadeOnDelete();
			$table->text('question');
			$table->text('image_path')->nullable();
            $table->enum('answer', ['A', 'B', 'C', 'D', 'E']);
			$table->integer('score');
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
		Schema::dropIfExists('questions');
	}
};
