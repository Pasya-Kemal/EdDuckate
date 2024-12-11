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

	Route::post('/logout', [\App\Http\Controllers\AuthController::class, 'logout']);
	Route::get('/logout', [\App\Http\Controllers\AuthController::class, 'logout']);
});

Route::prefix('/admin')->middleware([\App\Http\Middleware\Authenticate::class, \App\Http\Middleware\OnlyAdmin::class])->group(function() {
	Route::get('/', fn(\App\Models\User $user, \App\Models\Classroom $class, \App\Models\Major $major) => view('pages.admin.dashboard', ['user' => $user, 'class' => $class, 'major' => $major]));
	Route::prefix('/admin')->group(function() {
		Route::get('/', fn() => view('pages.admin.admin'));
		Route::get('/create', fn() => view('pages.admin.create_admin'));
		Route::post('/create', [\App\Http\Controllers\Admin\UserCreationController::class, 'createAdmin']);
		Route::delete('/delete/{user}', [\App\Http\Controllers\Admin\UserManagementController::class, 'deleteAdmin']);
	});
	Route::prefix('/teacher')->group(function() {
		Route::get('/', fn() => view('pages.admin.teacher'));
		Route::get('/create', fn() => view('pages.admin.create_teacher'));
		Route::get('/edit/{teacher}', fn(\App\Models\Teacher $teacher) => view('pages.admin.edit_teacher', ['teacher' => $teacher->load('user')]));
		Route::post('/create', [\App\Http\Controllers\Admin\UserCreationController::class, 'createTeacher']);
		Route::post('/update/{teacher}', [\App\Http\Controllers\Admin\UserManagementController::class, 'updateTeacher']);
		Route::delete('/delete/{teacher}', [\App\Http\Controllers\Admin\UserManagementController::class, 'deleteTeacher']);
	});
	Route::prefix('/student')->group(function() {
		Route::get('/', fn() => view('pages.admin.student'));
		Route::get('/create', fn() => view('pages.admin.create_student'));
		Route::get('/edit/{student}', fn(\App\Models\Student $student) => view('pages.admin.edit_student', ['student' => $student->load('user')]));
		Route::post('/create', [\App\Http\Controllers\Admin\UserCreationController::class, 'createStudent']);
		Route::post('/update/{student}', [\App\Http\Controllers\Admin\UserManagementController::class, 'updateStudent']);
		Route::delete('/delete/{student}', [\App\Http\Controllers\Admin\UserManagementController::class, 'deleteStudent']);

		Route::get('/exportToCsv/{student}', [\App\Http\Controllers\Admin\StudentController::class, 'exportToCsv']);
	});
	Route::prefix('/major')->group(function() {
		Route::get('/', fn() => view('pages.admin.major'));
		Route::get('/create', fn() => view('pages.admin.create_major'));
		Route::get('/edit/{major}', fn(\App\Models\Major $major) => view('pages.admin.edit_major', ['major' => $major]));
		Route::post('/create', [\App\Http\Controllers\Admin\MajorController::class, 'create']);
		Route::post('/update/{major}', [\App\Http\Controllers\Admin\MajorController::class, 'update']);
		Route::delete('/delete/{major}', [\App\Http\Controllers\Admin\MajorController::class, 'delete']);
	});
	Route::prefix('/classroom')->group(function() {
		Route::get('/', fn() => view('pages.admin.classroom'));
		Route::get('/create', fn() => view('pages.admin.create_classroom'));
		Route::get('/edit/{classroom}', fn(\App\Models\Classroom $classroom) => view('pages.admin.edit_classroom', ['classroom' => $classroom]));
		Route::post('/create', [\App\Http\Controllers\Admin\ClassroomController::class, 'create']);
		Route::post('/update/{classroom}', [\App\Http\Controllers\Admin\ClassroomController::class, 'update']);
		Route::delete('/delete/{classroom}', [\App\Http\Controllers\Admin\ClassroomController::class, 'delete']);

		Route::get('/listByMajor/{major}', [\App\Http\Controllers\Admin\ClassroomController::class, 'allByMajorID'])
			->withoutMiddleware(\App\Http\Middleware\OnlyAdmin::class)
			->middleware(\App\Http\Middleware\OnlyAdminTeacher::class);
	});
	Route::prefix('/settings')->group(function(){
		Route::get('/', fn() => view('pages.admin.settings'));
	});
});

Route::prefix('/teacher')->middleware([\App\Http\Middleware\Authenticate::class, \App\Http\Middleware\OnlyTeacher::class])->group(function() {
	Route::get('/', fn(\App\Models\User $user, \App\Models\Subject $subject, \App\Models\Presence $presence, \App\Models\Question $question, \App\Models\PresenceSubmission $submission) => view('pages.teacher.dashboard', ['user' => $user, 'subject' => $subject, 'presence' => $presence, 'question' => $question, 'submission' => $submission]));

	Route::prefix('/subject')->group(function(){
		Route::get('/', fn() => view('pages.teacher.subject'));
		Route::post('/create', [\App\Http\Controllers\Teacher\SubjectController::class, 'create']);
		Route::get('/create', fn() => view('pages.teacher.create_subject'));

		Route::get('/edit/{subject}', fn(\App\Models\Subject $subject) => view('pages.teacher.edit_subject', ['subject' => $subject]));
		Route::post('/edit/{subject}', [\App\Http\Controllers\Teacher\SubjectController::class, 'update']);

		Route::get('/createQuestion/{subject}', fn(\App\Models\Subject $subject) => view('pages.teacher.create_question', ['subject' => $subject]));
		Route::post('/createQuestion/{subject}', [\App\Http\Controllers\Teacher\QuestionController::class, 'create']);

		Route::get('/editQuestion/{question}', fn(\App\Models\Question $question) => view('pages.teacher.edit_question', ['question' => $question]));
		Route::post('/editQuestion/{question}', [\App\Http\Controllers\Teacher\QuestionController::class, 'edit']);

		Route::get('/questions/{subject}', fn(\App\Models\Subject $subject) => view('pages.teacher.question', ['subject' => $subject]));

		Route::delete('/delete/{subject}', [\App\Http\Controllers\Teacher\SubjectController::class, 'delete']);
		Route::delete('/deleteQuestion/{question}', [\App\Http\Controllers\Teacher\QuestionController::class, 'delete']);
        Route::get('/getcam/{subject}', [\App\Http\Controllers\Teacher\SubjectController::class, 'getcam']);
	});

	Route::prefix('/score')->group(function(){
		Route::get('/', fn() => view('pages.teacher.score'));
		Route::get('/exportToCsv/{subject}', [\App\Http\Controllers\Teacher\ScoreController::class, 'exportToCsv']);
	});

	Route::prefix('/presence')->group(function() {
		Route::get('/', fn() => view('pages.teacher.presence'));
		Route::get('/create', fn() => view('pages.teacher.create_presence'));
		Route::post('/create', [\App\Http\Controllers\Teacher\PresenceController::class, 'create']);

		Route::get('/edit/{presence}', fn(\App\Models\Presence $presence) => view('pages.teacher.edit_presence', ['presence' => $presence]));
		Route::post('/edit/{presence}', [\App\Http\Controllers\Teacher\PresenceController::class, 'update']);
		Route::delete('/delete/{presence}', [\App\Http\Controllers\Teacher\PresenceController::class, 'delete']);

		Route::get('/submission/{presence}', fn(\App\Models\Presence $presence) => view('pages.teacher.submission', ['presence' => $presence]));
	});

	Route::prefix('/settings')->group(function(){
		Route::get('/', fn() => view('pages.teacher.settings'));
	});
});
