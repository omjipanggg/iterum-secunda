<?php

namespace App\Models;

use App\Traits\UserInCharge;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class OfferingLetter extends Model
{
    use HasFactory, SoftDeletes, UserInCharge;

    protected $table = 'offering_letters';
    protected $guarded = [];

    protected $casts = [
    	'has_changed' => 'boolean'
    ];

    public function score() {
    	return $this->belongsTo(InterviewScore::class, 'interview_score_id');
    }

    public function contract() {
        return $this->hasOne(Contract::class);
    }

    public function schedule() {
    	return $this->hasOneThrough(InterviewSchedule::class, InterviewScore::class);
    }
}
