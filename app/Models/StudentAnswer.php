<?php

declare(strict_types=1);

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class StudentAnswer
 *
 * @property int $id
 * @property int $student_id
 * @property int $question_id
 * @property int $subject_id
 * @property string $answer
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 *
 * @property Question $question
 * @property Student $student
 *
 * @package App\Models
 */
class StudentAnswer extends Model
{
	protected $table = 'student_answers';

	protected $casts = [
		'student_id' => 'int',
		'question_id' => 'int',
		'subject_id' => 'int'
	];

	protected $fillable = [
		'student_id',
		'question_id',
		'subject_id',
		'answer'
	];

	public function question()
	{
		return $this->belongsTo(Question::class);
	}

	public function student()
	{
		return $this->belongsTo(Student::class, 'student_id', 'user_id');
	}

	public function subject()
	{
		return $this->belongsTo(Subject::class);
	}
}
