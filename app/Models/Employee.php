<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Employee extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'employees';
    protected $guarded = [];

    public function region() {
    	return $this->belongsTo(Region::class, 'region_id');
    }

    public function profile() {
        return $this->belongsTo(Profile::class, 'profile_id');
    }
}
