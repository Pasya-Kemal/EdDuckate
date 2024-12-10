<?php

declare(strict_types=1);

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::prefix('/')->middleware([\App\Http\Middleware\Authenticate::class, \App\Http\Middleware\OnlyStudent::class])->group(function() {
	Route::get('/', [\App\Http\Controllers\Student\HomeController::class, 'home'])->withoutMiddleware(\App\Http\Middleware\OnlyStudent::class);
	Route::get('/rules/{subject}', fn(\App\Models\Subject $subject) => view('pages.student.rules', ['subject' => $subject]));
	Route::get('/subject/{subject}', [\App\Http\Controllers\Student\SubjectController::class, 'view']);
	Route::prefix('/presence')->group(function(){
		Route::get('/{presence}', fn(\App\Models\Presence $presence) => view('pages.student.presence', ['presence' => $presence]));
		Route::post('/{presence}/submit', [\App\Http\Controllers\Student\PresenceController::class, 'submit']);
	});
	Route::post('/subject/{subject}/submit', [\App\Http\Controllers\Student\SubjectController::class, 'submit']);

	Route::post('/answerQuestion/{question}', [\App\Http\Controllers\Student\QuestionController::class, 'answer'])->withoutMiddleware(\App\Http\Middleware\VerifyCsrfToken::class);
	Route::post('/submitCam', [\App\Http\Controllers\Student\SubjectController::class, 'submitCam'])->withoutMiddleware(\App\Http\Middleware\VerifyCsrfToken::class);

    Route::get('/subject/{subject}/oncheat', [\App\Http\Controllers\Student\SubjectController::class, 'oncheat']);

	Route::get('/loadQuestions/{subject}', [\App\Http\Controllers\Student\SubjectController::class, 'loadQuestions']);
});

Route::prefix('/auth')->group(function() {
	Route::get('/login', function() {
		return view('pages.auth.login');
	});
	Route::post('/login', [\App\Http\Controllers\AuthController::class, 'login']);
});

Route::prefix('/admin')->middleware([\App\Http\Middleware\Authenticate::class, \App\Http\Middleware\OnlyAdmin::class])->group(function() {
	Route::get('/', fn(\App\Models\User $user, \App\Models\Classroom $class, \App\Models\Major $major) => view('pages.admin.dashboard', ['user' => $user, 'class' => $class, 'major' => $major]));
	Route::prefix('/admin')->group(function() {
		Route::get('/', fn() => view('pages.admin.admin'));
		Route::get('/create', fn() => view('pages.admin.create_admin'));
		Route::post('/create', [\App\Http\Controllers\Admin\UserCreationController::class, 'createAdmin']);
	});
	Route::prefix('/teacher')->group(function() {
		Route::get('/', fn() => view('pages.admin.teacher'));
		Route::get('/create', fn() => view('pages.admin.create_teacher'));
	});
	Route::prefix('/student')->group(function() {
		Route::get('/', fn() => view('pages.admin.student'));
		Route::get('/create', fn() => view('pages.admin.create_student'));
	});
	Route::prefix('/major')->group(function() {
		Route::get('/', fn() => view('pages.admin.major'));
		Route::get('/create', fn() => view('pages.admin.create_major'));
	});
	Route::prefix('/classroom')->group(function() {
		Route::get('/', fn() => view('pages.admin.classroom'));
		Route::get('/create', fn() => view('pages.admin.create_classroom'));

		Route::get('/listByMajor/{major}', [\App\Http\Controllers\Admin\ClassroomController::class, 'allByMajorID'])
			->withoutMiddleware(\App\Http\Middleware\OnlyAdmin::class)
			->middleware(\App\Http\Middleware\OnlyAdminTeacher::class);
	});
});

Route::prefix('/teacher')->middleware([\App\Http\Middleware\Authenticate::class, \App\Http\Middleware\OnlyTeacher::class])->group(function() {
	Route::get('/', fn(\App\Models\User $user, \App\Models\Subject $subject, \App\Models\Presence $presence, \App\Models\Question $question, \App\Models\PresenceSubmission $submission) => view('pages.teacher.dashboard', ['user' => $user, 'subject' => $subject, 'presence' => $presence, 'question' => $question, 'submission' => $submission]));

	Route::prefix('/subject')->group(function(){
		Route::get('/', fn() => view('pages.teacher.subject'));
		Route::post('/create', [\App\Http\Controllers\Teacher\SubjectController::class, 'create']);
		Route::get('/create', fn() => view('pages.teacher.create_subject'));
	});

	Route::prefix('/presence')->group(function() {
		Route::get('/', fn() => view('pages.teacher.presence'));
		Route::get('/create', fn() => view('pages.teacher.create_presence'));
		Route::post('/create', [\App\Http\Controllers\Teacher\PresenceController::class, 'create']);
	});
});
