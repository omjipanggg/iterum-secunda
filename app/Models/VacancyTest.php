<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class VacancyTest extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'vacancy_tests';
    protected $guarded = [];

    public function vacancy() {
    	return $this->belongsTo(Vacancy::class, 'vacancy_id');
    }

    public function category() {
    	return $this->belongsTo(TestCategory::class, 'category_id');
    }
}
