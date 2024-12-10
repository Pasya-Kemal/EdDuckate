<?php

declare(strict_types=1);

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Classroom;
use App\Models\Major;
use App\Services\Admin\MajorService;
use Illuminate\Http\Request;
use function back;

class MajorController extends Controller{

	public function create(Request $request) {
		$request->validate([
			'name' => 'required|string|regex:/^[a-zA-Z\s]*$/'
		]);

		MajorService::getInstance()->create($request->post('name'));
		$request->session()->flash('message', 'Major created.');
		return back();
	}

	public function update(Major $major, Request $request) {
		$request->validate([
			'name' => 'required|string|regex:/^[a-zA-Z\s]*$/'
		]);

		MajorService::getInstance()->update($major, $request->post('name'));

		$request->session()->flash('message', 'Major updated.');
		return back();
	}

	public function delete(Major $major, Request $request) {
		MajorService::getInstance()->delete($major);

		$request->session()->flash('message', 'Major deleted.');
		return back();
	}

	public function all(Request $request) {
		Classroom::query()->paginate(20);
	}
}
