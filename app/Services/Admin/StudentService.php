<?php

declare(strict_types=1);

namespace App\Services\Admin;

use App\Helpers\CSV;
use App\Models\Score;
use App\Models\Student;
use App\Models\Subject;
use App\Traits\SingletonTrait;

class StudentService{

	use SingletonTrait;

	public function exportToCsv(Student $student) : string{
		$subject = Subject::query()->get();
		$checks = Score::query()
		->where('student_id', '=', $student->user_id)
		->with('subject')
		->with('student')
		->get();

		if (empty($checks)) {
			return '';
		}

		$data = [];
		$data[] = [
			'External ID',
			'Full Name',
			'Subject',
			'Status'
		];
		foreach($checks as $check) {
			$data[] = [
				$check->student->external_id,
				$check->student->full_name,
				$subject->name,
				$status = $check->subject->id == $check->subject_id ? 'clear' : 'not clear'
			];
		}
		return CSV::create($data);
	}
}
