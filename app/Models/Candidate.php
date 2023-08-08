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
    	return $this->belongsToMany(Vacancy::class, 'candidates_and_vacancies')->orderByDesc('created_at');
    }
}
