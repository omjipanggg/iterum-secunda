<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class FileProfile extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'file_profiles';
    protected $guarded = [];
}
