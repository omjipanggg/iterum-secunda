<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Experience extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'experiences';
    protected $guarded = [];

    public function profile() {
    	return $this->belongsTo(Profile::class, 'profile_id');
    }

    public function city() {
    	return $this->belongsTo(City::class, 'city_id');
    }
}
