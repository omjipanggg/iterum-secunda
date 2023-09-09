<?php

namespace App\Models;

use App\Traits\HasUuids;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Profile extends Model
{
    use HasFactory, HasUuids, SoftDeletes;

    protected $table = 'profiles';

    protected $guarded = [];

    protected $dates = [
        'date_of_birth'
    ];

    public function user() {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function gender() {
        return $this->belongsTo(Gender::class, 'gender_id');
    }

    public function city() {
        return $this->belongsTo(City::class, 'city_id');
    }

    public function candidate() {
        return $this->hasOne(Candidate::class, 'profile_id');
    }

    public function employee() {
        return $this->hasOne(Employee::class, 'profile_id');
    }

    public function last_education() {
        return $this->hasMany(LastEducation::class, 'profile_id')->orderByDesc('graduation_year');
    }

    public function experience() {
        return $this->hasMany(Experience::class, 'profile_id')->orderByDesc('starting_date');
    }

    public function skills() {
        return $this->belongsToMany(Skill::class, 'capabilities')->withPivot(['certificate', 'rate']);
    }

    public function attachments() {
        return $this->hasMany(FileProfile::class, 'profile_id')->orderBy('file_profiles.file_category_id');
    }

    public function family() {
        return $this->hasMany(Relative::class, 'profile_id')->orderBy('relatives.close_relation_id');
    }
}
