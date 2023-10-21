<?php

namespace App\Models;

use App\Traits\HasUuids;
use App\Traits\UserInCharge;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class InterviewSchedule extends Model
{
    use HasFactory, HasUuids, SoftDeletes, UserInCharge;

    protected $table = 'interview_schedules';
    protected $guarded = [];

    protected $casts = [
    	'id' => 'string',
    	'has_changed' => 'boolean',
	];

	public function proposal() {
		return $this->belongsTo(Proposal::class, 'proposal_id');
	}

    public function score() {
        return $this->hasOne(InterviewScore::class, 'interview_schedule_id');
    }
}