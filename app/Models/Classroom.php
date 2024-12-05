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
 * Class Classroom
 *
 * @property int $id
 * @property string $name
 * @property int $major_id
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 *
 * @property Major $major
 * @property Collection|Student[] $students
 *
 * @package App\Models
 */
class Classroom extends Model
{
	protected $table = 'classroom';

	protected $casts = [
		'major_id' => 'int'
	];

	protected $fillable = [
		'name',
		'major_id'
	];

	public function major()
	{
		return $this->belongsTo(Major::class);
	}

	public function students()
	{
		return $this->hasMany(Student::class);
	}
}
