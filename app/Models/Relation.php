<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Relation extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'close_relations';
    protected $guarded = [];

    public function relative() {
    	return $this->hasMany(Relative::class, 'close_relation_id');
    }
}
