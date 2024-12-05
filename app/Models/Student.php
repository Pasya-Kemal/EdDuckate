<?php

declare(strict_types=1);

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Student
 *
 * @property int $user_id
 * @property string $external_id
 * @property string $full_name
 * @property int $major_id
 * @property string $image
 * @property int $classroom_id
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 *
 * @property Classroom $classroom
 * @property Major $major
 * @property User $user
 *
 * @package App\Models
 */
class Student extends Model
{
	protected $table = 'students';
	protected $primaryKey = 'user_id';
	public $incrementing = false;

	protected $casts = [
		'user_id' => 'int',
		'major_id' => 'int',
		'classroom_id' => 'int'
	];

	protected $fillable = [
		'external_id',
		'full_name',
		'major_id',
		'classroom_id',
		'image',
	];

	public function classroom()
	{
		return $this->belongsTo(Classroom::class);
	}

	public function major()
	{
		return $this->belongsTo(Major::class);
	}

	public function user()
	{
		return $this->belongsTo(User::class);
	}
}
