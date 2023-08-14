<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class VacancyType extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'vacancy_types';
    protected $guarded = [];
}
