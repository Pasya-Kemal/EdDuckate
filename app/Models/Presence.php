<?php

declare(strict_types=1);

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Presence
 *
 * @property int $id
 * @property string $name
 * @property int $teacher_id
 * @property int|null $classroom_id
 * @property int|null $major_id
 * @property Carbon $starts_at
 * @property Carbon $ends_at
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 *
 * @property Classroom|null $classroom
 * @property Major|null $major
 * @property Teacher $teacher
 * @property Collection|PresenceSubmission[] $presence_submissions
 *
 * @package App\Models
 */
class Presence extends Model
{
	protected $table = 'presences';

	protected $casts = [
		'teacher_id' => 'int',
		'classroom_id' => 'int',
		'major_id' => 'int',
		'starts_at' => 'datetime',
		'ends_at' => 'datetime'
	];

	protected $fillable = [
		'name',
		'teacher_id',
		'classroom_id',
		'major_id',
		'starts_at',
		'ends_at'
	];

	public function classroom()
	{
		return $this->belongsTo(Classroom::class);
	}

	public function major()
	{
		return $this->belongsTo(Major::class);
	}

	public function teacher()
	{
		return $this->belongsTo(Teacher::class, 'teacher_id', 'user_id');
	}

	public function presence_submissions()
	{
		return $this->hasMany(PresenceSubmission::class);
	}
}
