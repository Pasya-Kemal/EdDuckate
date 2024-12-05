<?php

declare(strict_types=1);

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Question
 *
 * @property int $id
 * @property int $subject_id
 * @property string $question
 * @property string|null $image_path
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property string $answer
 * @property int $score
 *
 * @property Subject $subject
 *
 * @package App\Models
 */
class Question extends Model
{
	protected $table = 'questions';

	protected $casts = [
		'subject_id' => 'int',
		'score' => 'int'
	];

	protected $fillable = [
		'subject_id',
		'question',
		'image_path',
		'answer',
		'score'
	];

	public function subject()
	{
		return $this->belongsTo(Subject::class);
	}
}
