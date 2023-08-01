<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class HigherEducation extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'higher_educations';
    protected $guarded = [];
}
