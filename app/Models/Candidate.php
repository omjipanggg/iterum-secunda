<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Candidate extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'candidates';
    protected $guarded = [];

    public function appliedTo() {
    	return $this->belongsToMany(Vacancy::class, 'proposals')->orderByDesc('created_at')->withPivot(['description', 'resume', 'status']);
    }

    public function profile() {
        return $this->belongsTo(Profile::class, 'profile_id');
    }
}
