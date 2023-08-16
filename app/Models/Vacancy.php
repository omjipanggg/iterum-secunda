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

    public function skills() {
        return $this->belongsToMany(Skill::class, 'skills_and_vacancies')->orderBy('skills.name');
    }

    public function education() {
        return $this->belongsToMany(Education::class, 'education_and_vacancies')->orderBy('education.name');
    }

    public function candidates() {
    	return $this->belongsToMany(Candidate::class, 'proposals')->orderByDesc('created_at')->withPivot(['status']);
    }

    public function project() {
        return $this->belongsTo(Project::class, 'project_id');
    }

    public function city() {
        return $this->belongsTo(City::class, 'city_id');
    }

    public function scopeFilter($query, $filter) {
        $query->when($filter ?? false, function($query, $search) {
            return $query->where('name', 'like', '%'. $search .'%')
                ->orWhere('placement', 'like', '%'. $search .'%')
                ->orWhere('description', 'like', '%'. $search .'%')
                ->orWhere('qualification', 'like', '%'. $search .'%')
                ->orWhereHas('project', function($query) use($search) {
                    $query->where('project_number', 'like', '%'. $search .'%');
                })
                ->orWhereHas('project', function($query) use($search) {
                    $query->whereHas('partner', function($query) use($search) {
                        $query->where('name', 'like', '%'. $search .'%');
                    });
                })
                ->orWhereHas('type', function($query) use($search) {
                    $query->where('name', 'like', '%'. $search .'%');
                }
            );
        });
    }

    public function categories() {
        return $this->belongsToMany(VacancyCategory::class, 'categories_and_vacancies')->orderBy('name');
    }

    public function hasCategory($id) {
        if (!is_array($id)) { $id = [$id]; }
        return $this->categories()->whereIn('vacancy_category_id', $id)->exists();
    }
}
