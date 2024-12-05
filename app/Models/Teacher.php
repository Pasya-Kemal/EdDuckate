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
 * Class Teacher
 *
 * @property int $user_id
 * @property string $external_id
 * @property string $full_name
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 *
 * @property User $user
 * @property Collection|Major[] $majors
 *
 * @package App\Models
 */
class Teacher extends Model
{
	protected $table = 'teachers';
	protected $primaryKey = 'user_id';
	public $incrementing = false;

	protected $casts = [
		'user_id' => 'int'
	];

	protected $fillable = [
		'external_id',
		'full_name'
	];

	public function user()
	{
		return $this->belongsTo(User::class);
	}

	public function majors()
	{
		return $this->belongsToMany(Major::class, 'teacher_majors')
					->withTimestamps();
	}
}
