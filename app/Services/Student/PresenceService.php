<?php

declare(strict_types=1);

namespace App\Services\Student;

use App\Models\Presence;
use App\Models\PresenceSubmission;
use App\Traits\SingletonTrait;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;
use function public_path;

class PresenceService{

	use SingletonTrait;

	public function hasSubmitted(Presence $presence, int $studentID) : bool {
		return PresenceSubmission::query()->where('presence_id', '=', $presence->id)->where('student_id', '=', $studentID)->exists();
	}

	public function submit(Presence $presence, int $studentID, string $status, string $signature, string $ip, string $userAgent) : void{
		$fileName = Str::random() . '.png';
		PresenceSubmission::query()->create([
			'presence_id' => $presence->id,
			'status' => $status,
			'student_id' => $studentID,
			'signature_src' => $fileName,
			'user_agent' => $userAgent,
			'ip_address' => $ip,
		]);
		File::put(public_path('images/signature/') . $fileName, $signature);
	}
}
