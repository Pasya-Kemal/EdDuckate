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
		Schema::create('presences', function (Blueprint $table) {
			$table->id();
			$table->string('name');
			$table->foreignId('teacher_id')->references('user_id')->on('teachers')->cascadeOnDelete();
			$table->foreignId('classroom_id')->nullable()->references('id')->on('classroom')->cascadeOnDelete();
			$table->foreignId('major_id')->nullable()->references('id')->on('majors')->cascadeOnDelete();
			$table->dateTime('starts_at');
			$table->dateTime('ends_at');
			$table->timestamps();
		});
	}

	/**
	 * Reverse the migrations.
	 */
	public function down() : void
	{
		Schema::dropIfExists('presences');
	}
};
