<?php

namespace App\Models;

use App\Traits\HasUuids;
use App\Traits\UserInCharge;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Vacancy extends Model
{
    use HasFactory, HasUuids, SoftDeletes, UserInCharge;

    protected $table = 'vacancies';
    protected $guarded = [];

    protected $casts = [
    	'active' => 'boolean',
    	'hidden_partner' => 'boolean',
    	'hidden_placement' => 'boolean',
    	'published_at' => 'datetime',
        'opening_date' => 'datetime',
        'closing_date' => 'datetime'
    ];

    public function type() {
    	return $this->belongsTo(VacancyType::class, 'vacancy_type_id');
    }

    public function candidates() {
    	return $this->belongsToMany(Candidate::class, 'candidates_and_vacancies')->orderByDesc('created_at');
    }

    public function project() {
        return $this->belongsTo(Project::class, 'project_id');
    }
}
