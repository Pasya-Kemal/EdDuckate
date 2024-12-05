<?php

declare(strict_types=1);

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class PresenceSubmission
 *
 * @property int $id
 * @property int $presence_id
 * @property int $student_id
 * @property string $status
 * @property string $ip_address
 * @property string $user_agent
 * @property string|null $signature_src
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 *
 * @property Presence $presence
 * @property Student $student
 *
 * @package App\Models
 */
class PresenceSubmission extends Model
{
	protected $table = 'presence_submissions';

	protected $casts = [
		'presence_id' => 'int',
		'student_id' => 'int'
	];

	protected $fillable = [
		'presence_id',
		'student_id',
		'status',
		'ip_address',
		'user_agent',
		'signature_src'
	];

	public function presence()
	{
		return $this->belongsTo(Presence::class);
	}

	public function student()
	{
		return $this->belongsTo(Student::class, 'student_id', 'user_id');
	}
}
