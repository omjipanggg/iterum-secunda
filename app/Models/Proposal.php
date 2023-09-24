<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Proposal extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'proposals';
    protected $guarded = [];

    public function vacancy() {
    	return $this->belongsTo(Vacancy::class, 'vacancy_id');
    }

    public function candidate() {
    	return $this->belongsTo(Candidate::class, 'candidate_id');
    }

    public function schedules() {
    	return $this->hasMany(InterviewSchedule::class, 'proposal_id');
    }
}