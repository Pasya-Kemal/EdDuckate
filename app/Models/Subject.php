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
 * Class Subject
 *
 * @property int $id
 * @property string $name
 * @property Carbon $starts_at
 * @property Carbon $ends_at
 * @property bool $shuffle_questions
 * @property bool $shuffle_answers
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 *
 * @property Collection|Question[] $questions
 *
 * @package App\Models
 */
class Subject extends Model
{
	protected $table = 'subjects';

	protected $casts = [
		'starts_at' => 'datetime',
		'ends_at' => 'datetime',
		'shuffle_questions' => 'bool',
		'shuffle_answers' => 'bool'
	];

	protected $fillable = [
		'name',
		'starts_at',
		'ends_at',
		'shuffle_questions',
		'shuffle_answers'
	];

	public function questions()
	{
		return $this->hasMany(Question::class);
	}
}
