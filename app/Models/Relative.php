<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Relative extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'relatives';
    protected $guarded = [];

    public function relation() {
    	return $this->belongsTo(Relation::class, 'close_relation_id');
    }

    public function education() {
    	return $this->belongsTo(Education::class, 'education_id');
    }
}
