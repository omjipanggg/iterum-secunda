<?php

namespace App\Models;

use App\Traits\HasUuids;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

use Illuminate\Support\Carbon;

class Candidate extends Model
{
    use HasFactory, HasUuids, SoftDeletes;

    protected $table = 'candidates';
    protected $guarded = [];

    public function appliedTo() {
    	return $this->belongsToMany(Vacancy::class, 'proposals')->orderByDesc('created_at')->withPivot(['description', 'resume', 'status']);
    }

    public function profile() {
        return $this->belongsTo(Profile::class, 'profile_id');
    }

    public function scopeHasAge($query, $age) {
        return $query->when($age ?? false, function($query, $age) {
            $query->whereHas('profile', function($query) use($age) {
                $query->whereRaw('DATEDIFF("' . Carbon::now()->toDateString() . '", date_of_birth)/365 < ' . $age + 1);
            });
        });
    }

    public function scopeHasGenders($query, $genders) {
        return $query->when($genders ?? false, function($query, $genders) {
            $query->whereHas('profile', function($query) use($genders) {
                $query->whereIn('gender_id', $genders);
            });
        });
    }

    public function scopeHasCities($query, $cities) {
        return $query->when($cities ?? false, function($query, $cities) {
            $query->whereHas('profile', function($query) use($cities) {
                $query->whereIn('city_id', $cities);
            });
        });
    }

    public function scopeHasEducation($query, $education) {
        return $query->when($education ?? false, function($query, $education) {
            $query->whereHas('profile', function($query) use($education) {
                $query->whereHas('last_education', function($query) use($education) {
                    $query->whereIn('education_id', $education);
                });
            });
        });
    }

    public function scopeHasExpectedSalary($query, $limit) {
        return $query->when($limit ?? false, function($query, $limit) {
            $query->whereBetween('expected_salary', [$limit['min'], $limit['max']]);
        });
    }

    public function scopeHasAvailability($query, $availability) {
        return $query->when($availability ?? false, function($query) use($availability) {
            $query->where('ready_to_work', $availability);
        });
    }
}
