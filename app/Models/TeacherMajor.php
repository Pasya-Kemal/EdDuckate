<?php

declare(strict_types=1);

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class TeacherMajor
 *
 * @property int $teacher_id
 * @property int $major_id
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 *
 * @property Major $major
 * @property Teacher $teacher
 *
 * @package App\Models
 */
class TeacherMajor extends Model
{
	protected $table = 'teacher_majors';
	public $incrementing = false;

	protected $casts = [
		'teacher_id' => 'int',
		'major_id' => 'int'
	];

	protected $fillable = [
		'teacher_id',
		'major_id'
	];

	public function major()
	{
		return $this->belongsTo(Major::class);
	}

	public function teacher()
	{
		return $this->belongsTo(Teacher::class);
	}
}
