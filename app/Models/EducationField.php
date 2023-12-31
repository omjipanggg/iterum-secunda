<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class EducationField extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'education_fields';
    protected $guarded = [];
}
