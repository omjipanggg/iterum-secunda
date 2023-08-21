<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class LastEducation extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'last_education';
    protected $guarded = [];

    public function profile() {
    	return $this->belongsTo(Profile::class, 'profile_id');
    }

    public function education() {
    	return $this->belongsTo(Education::class, 'education_id');
    }

    public function higherEducation() {
    	return $this->belongsTo(HigherEducation::class, 'higher_education_id');
    }

    public function educationField() {
    	return $this->belongsTo(EducationField::class, 'education_field_id');
    }

    public function city() {
    	return $this->belongsTo(city::class, 'city_id');
    }
}
