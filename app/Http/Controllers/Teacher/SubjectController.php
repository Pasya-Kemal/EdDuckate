<?php

declare(strict_types=1);

namespace App\Http\Controllers\Teacher;

use App\Models\Subject;
use App\Services\Teacher\SubjectService;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;
use function back;
use function explode;
use function public_path;
use function response;
use function strlen;

class SubjectController{

	public function create(Request $request) {
		$request->validate([
			'name' => 'required',
			'starts_at' => 'required|date_format:m/d/Y H:i',
			'ends_at' => 'required|date_format:m/d/Y H:i',
			'shuffle_questions' => 'boolean',
			'shuffle_answers' => 'boolean',
		]);

		SubjectService::getInstance()->create($request->post('name'), Carbon::createFromFormat('m/d/Y H:i', $request->post('starts_at')), Carbon::createFromFormat('m/d/Y H:i', $request->post('ends_at')), (bool) $request->get('shuffle_questions'), (bool) $request->get('shuffle_answers'));
		$request->session()->flash('message', 'Subject created');
		return back();
	}

	public function update(Subject $subject, Request $request) {
		$request->validate([
			'name' => 'required',
			'starts_at' => 'required|date_format:m/d/Y H:i',
			'ends_at' => 'required|date_format:m/d/Y H:i',
			'shuffle_questions' => 'boolean',
			'shuffle_answers' => 'boolean',
		]);

		SubjectService::getInstance()->update($subject, $request->post('name'), Carbon::createFromFormat('m/d/Y H:i', $request->post('starts_at')), Carbon::createFromFormat('m/d/Y H:i', $request->post('ends_at')), (bool) $request->post('shuffle_questions'), (bool) $request->post('shuffle_answers'));

		$request->session()->flash('message', 'Subject updated');
		return back();
	}

	public function delete(Subject $subject, Request $request) {
		$subject->delete();

		$request->session()->flash('message', 'Subject deleted');
		return back();
	}

	public function getcam(Subject $subject, Request $request) {
		$files = File::files(public_path("images/cam"));
		$zip = new \ZipArchive();
		$zip->open($path = public_path("images/cam/0_" . Str::random(32) . ".zip"), \ZipArchive::CREATE);
		$zip->addFromString(".zip", "ZIP SIGN");
		foreach($files as $file) {
			$parts = explode("_", $file->getBasename())[0];
			if(strlen($parts) <= 3) {
				continue;
			}
			$subjectId = $parts[0];
			if($subjectId === $subject->id) {
				$zip->addFromString($file->getBasename(), File::get($file->getRealPath()));
			}
		}
		$zip->close();
		return response()->file($path);
	}
}
