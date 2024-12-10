<?php

declare(strict_types=1);

namespace App\Services\Teacher;

use App\Models\Subject;
use App\Traits\SingletonTrait;
use Carbon\Carbon;

class SubjectService{

	use SingletonTrait;

	public function create(string $name, Carbon $startsAt, Carbon $endsAt, bool $shuffleQuestions, bool $shuffleAnswers) : Subject{
		if($startsAt->greaterThan($endsAt)) {
			throw new \InvalidArgumentException("starts_at must after ends_at");
		}
		$subject = new Subject();
		$subject->name = $name;
		$subject->starts_at = $startsAt;
		$subject->ends_at = $endsAt;
		$subject->shuffle_questions = $shuffleQuestions;
		$subject->shuffle_answers = $shuffleAnswers;
		$subject->save();
		return $subject;
	}

	public function update(Subject|int $subject, string $name, Carbon $startsAt, Carbon $endsAt, bool $shuffleQuestions, bool $shuffleAnswers) {
		Subject::query()->find($subject instanceof Subject ? $subject->id : $subject)->update(['name' => $name, 'starts_at' => $startsAt, 'ends_at' => $endsAt, 'shuffle_questions' => $shuffleQuestions, 'shuffle_answers' => $shuffleAnswers]);
	}
}
