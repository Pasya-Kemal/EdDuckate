<?php

declare(strict_types=1);

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Classroom;
use App\Models\Major;
use App\Services\Admin\ClassroomService;
use Illuminate\Http\Request;
use function back;
use function response;

class ClassroomController extends Controller{

	public function create(Request $request) {
		$request->validate([
			'name' => 'required|string',
			'major_id' => 'required|exists:majors,id'
		]);

		ClassroomService::getInstance()->create($request->post('name'), (int) $request->get('major_id'));

		$request->session()->flash('message', 'Classroom created.');
		return back();
	}

	public function update(Classroom $classroom, Request $request) {
		$request->validate([
			'name' => 'required|string',
			'major_id' => 'required|exists:majors,id',
		]);

		ClassroomService::getInstance()->update($classroom, $request->post('name'), (int) $request->post('major_id'));

		$request->session()->flash('message', 'Classroom updated.');
		return back();
	}

	public function delete(Classroom $classroom, Request $request) {
		ClassroomService::getInstance()->delete($classroom);

		$request->session()->flash('message', 'Classroom deleted.');
		return back();
	}

	public function all(Request $request) {
		Classroom::query()->paginate(20);
	}

	public function allByMajorID(Major $major, Request $request) {
		$results = Classroom::query()->where('major_id', '=', $major->id)->get();
		$classes = [];
		foreach($results as $result) {
			$classes[] = [
				'id' => $result->id,
				'name' => $result->name,
			];
		}
		return response()->json($classes);
	}
}
