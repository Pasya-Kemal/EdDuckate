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
		Schema::create('presence_submissions', function (Blueprint $table) {
			$table->id();
			$table->foreignId('presence_id')->references('id')->on('presences')->cascadeOnDelete();
			$table->foreignId('student_id')->references('user_id')->on('students')->cascadeOnDelete();
			$table->unique(['presence_id', 'student_id']);
			$table->enum('status', ['present', 'excused', 'sick']);
			$table->string('ip_address');
			$table->string('user_agent');
			$table->string('signature_src')->nullable()->comment('Signature saved at public/images/signature/*.png');
			$table->timestamps();
		});
	}

	/**
	 * Reverse the migrations.
	 */
	public function down() : void
	{
		Schema::dropIfExists('presence_submissions');
	}
};
