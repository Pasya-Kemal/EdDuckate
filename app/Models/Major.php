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
 * Class Major
 *
 * @property int $id
 * @property string $name
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 *
 * @property Collection|Classroom[] $classrooms
 * @property Collection|Student[] $students
 * @property Collection|Teacher[] $teachers
 *
 * @package App\Models
 */
class Major extends Model
{
	protected $table = 'majors';

	protected $fillable = [
		'name'
	];

	public function classrooms()
	{
		return $this->hasMany(Classroom::class);
	}

	public function students()
	{
		return $this->hasMany(Student::class);
	}

	public function teachers()
	{
		return $this->belongsToMany(Teacher::class, 'teacher_majors')
					->withTimestamps();
	}
}
