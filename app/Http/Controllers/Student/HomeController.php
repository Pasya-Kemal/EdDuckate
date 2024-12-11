<?php

declare(strict_types=1);

namespace App\Http\Controllers\Student;

use App\Models\Presence;
use App\Models\PresenceSubmission;
use App\Models\Student;
use App\Models\Subject;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use function redirect;
use function view;

class HomeController{

	public function home(Request $request){
		$role = $request->user()->getRole();
		switch($role) {
			case User::ROLE_ADMIN:
				return redirect('/admin');
			case User::ROLE_TEACHER:
				return redirect('/teacher');
		}

		/** @var Student $student */
		$student = Student::query()->find($request->user()->getUserId());
		$presences = Presence::query()->with('teacher', 'classroom')
			->where('starts_at', '<=', Carbon::now())
			->where('ends_at', '>=', Carbon::now())
			->where(function($query) use ($student) {
				$query->where('classroom_id', '=', $student->classroom_id)
					->orWhereNull('classroom_id');
			})
			->where(function($query) use ($student) {
				$query->where('major_id', '=', $student->major_id)
					->orWhereNull('major_id');
			})
			->get();

		$prsub = PresenceSubmission::query()->where('student_id', '=', $student->user_id)->get();
		$presences2 = [];
		foreach($presences as $pr) {
			$found = false;
			foreach($prsub as $prsubl) {
				if($prsubl->id === $pr->id) {
					$found = true;
					break;
				}
			}
			if(!$found) {
				$presences2[] = $pr;
			}
		}

		$subjects = Subject::query()
			->where('starts_at', '<=', Carbon::now())
			->where('ends_at', '>=', Carbon::now())
			->get();

		return view('pages.student.home', ['presences' => $presences2, 'subjects' => $subjects, 'student' => $student]);
	}
}
