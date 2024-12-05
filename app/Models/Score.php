<?php

declare(strict_types=1);

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Score
 *
 * @property int $student_id
 * @property int $subject_id
 * @property int $score
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property Carbon|null $submitted_at
 *
 * @property Student $student
 * @property Subject $subject
 *
 * @package App\Models
 */
class Score extends Model
{
	protected $table = 'scores';
	public $incrementing = false;

	protected $casts = [
		'student_id' => 'int',
		'subject_id' => 'int',
		'score' => 'int',
		'submitted_at' => 'datetime'
	];

	protected $fillable = [
		'student_id',
		'subject_id',
		'score',
		'submitted_at'
	];

	public function student()
	{
		return $this->belongsTo(Student::class, 'student_id', 'user_id');
	}

	public function subject()
	{
		return $this->belongsTo(Subject::class);
	}
}
