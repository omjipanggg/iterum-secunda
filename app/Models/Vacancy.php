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

    protected $dates = [
        'opening_date',
        'closing_date'
    ];

    public function position() {
        return $this->belongsTo(JobTitle::class, 'job_title_id');
    }

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
    	return $this->belongsToMany(Candidate::class, 'proposals')->orderByDesc('proposals.created_at')->withPivot(['description', 'resume', 'status'])->withTimestamps();
    }

    public function tests() {
        return $this->hasMany(VacancyTest::class, 'vacancy_id', 'id');
    }

    public function project() {
        return $this->belongsTo(Project::class, 'project_id');
    }

    public function region() {
        return $this->belongsTo(Region::class, 'region_id');
    }

    // public function regions() {
        // return $this->belongsToMany(Region::class, 'regions_and_vacancies')->orderBy('regions.code');
    // }

    public function city() {
        return $this->belongsTo(City::class, 'city_id');
    }

    public function scopeFilter($query, $filter) {
        $query->when($filter ?? false, function($query, $search) {
            return $query->orWhere('name', 'like', '%'. $search .'%')
                ->orWhere('placement', 'like', '%'. $search .'%')
                /*
                ->orWhere('description', 'like', '%'. $search .'%')
                ->orWhere('qualification', 'like', '%'. $search .'%')
                */
                ->orWhereHas('project', function($query) use($search) {
                    $query->orWhere('project_number', 'like', '%'. $search .'%');
                })
                ->orWhereHas('project', function($query) use($search) {
                    $query->orWhere('project_number', $search)->orWhereHas('partner', function($query) use($search) {
                        $query->orWhere('name', 'like', '%'. $search .'%');
                    });
                })
                ->orWhereHas('type', function($query) use($search) {
                    $query->orWhere('name', 'like', '%'. $search .'%');
                }
            );
        });
    }

    public function scopeYearlyCount($query) {
        $starting_date = mktime(0, 0, 0, 1, 1, date("Y"));
        $starting_date = date("Y-m-d", $starting_date);

        $ending_date = mktime(0, 0, 0, 12, 31, date("Y"));
        $ending_date = date("Y-m-d", $ending_date);

        return $query->whereBetween('created_at', [$starting_date, $ending_date])
            ->orderByDesc('created_at')
            ->get()
            ->groupBy(function ($vacancy) { return $vacancy->created_at->format('M'); })
            ->map(function ($vacancyGroup) { return $vacancyGroup->count(); });
    }

    public function categories() {
        return $this->belongsToMany(VacancyCategory::class, 'categories_and_vacancies')->orderBy('vacancy_categories.name');
    }

    public function hasCategory($id) {
        if (!is_array($id)) { $id = [$id]; }
        return $this->categories()->whereIn('vacancy_category_id', $id)->exists();
    }

    public function creator() {
        return $this->belongsTo(User::class, 'created_by');
    }

    public function editor() {
        return $this->belongsTo(User::class, 'updated_by');
    }

    public function terminator() {
        return $this->belongsTo(User::class, 'deleted_by');
    }
}