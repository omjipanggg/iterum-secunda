<?php

namespace App\Models;

use App\Traits\HasUuids;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Partner extends Model
{
    use HasFactory, HasUuids, SoftDeletes;

    protected $table = 'partners';
    protected $guarded = [];

    public function city() {
    	return $this->belongsTo(City::class, 'city_id');
    }
}
