<?php

declare(strict_types=1);

namespace App\Services\Teacher;

use App\Models\Classroom;
use app\Models\Major;
use App\Models\Presence;
use App\Models\Teacher;
use App\Traits\SingletonTrait;
use Carbon\Carbon;

class PresenceService{

	use SingletonTrait;

	public function create(string $name, int $teacherId, Classroom|int $classroom, Major|int $major, Carbon $startsAt, Carbon $endsAt) : Presence{
		if($startsAt->greaterThan($endsAt)) {
			throw new \InvalidArgumentException("starts_at must after ends_at");
		}
		$presence = new Presence();
		$presence->name = $name;
		$presence->teacher_id = $teacherId;
		$presence->classroom_id = $classroom instanceof Classroom ? $classroom->id : $classroom;
		$presence->major_id = $major instanceof Major ? $major->id : $major;
		$presence->starts_at = $startsAt;
		$presence->ends_at = $endsAt;
		$presence->save();
		return $presence;
	}

	public function update(Presence|int $presence, string $name, Teacher|int $teacher, Classroom|int $classroom, Major|int $major, Carbon $startsAt, Carbon $endsAt) {
		Presence::query()->find($presence instanceof Presence ? $presence->id : $presence)
			->update([
				'name' => $name,
				'teacher_id' => $teacher instanceof Teacher ? $teacher->id : $teacher,
				'classroom_id' => $classroom instanceof Classroom ? $classroom->id : $classroom,
				'major_id' => $major instanceof Major ? $major->id : $major,
				'starts_at' => $startsAt,
				'ends_at' => $endsAt
			]);
	}
}
