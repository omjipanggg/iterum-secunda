<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class VacancyCategory extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'vacancy_categories';
    protected $guarded = [];

    public function vacancies() {
    	return $this->belongsToMany(Vacancy::class, 'categories_and_vacancies')->orderBy('name');
    }
}
