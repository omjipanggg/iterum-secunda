<?php

namespace App\Models;

use App\Traits\HasUuids;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Region extends Model
{
    use HasFactory, HasUuids, SoftDeletes;

    protected $table = 'regions';
    protected $guarded = [];

    public function employees() {
    	return $this->hasMany(Employee::class, 'region_id', 'id');
    }

    /*
    public function vacancies() {
        return $this->belongsToMany(Vacancy::class, 'regions_and_vacancies')->orderBy('regions.code');
    }
    */
}
