<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Role extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'roles';
    protected $guarded = [];

    public function users() {
    	return $this->belongsToMany(User::class, 'roles_and_users')->orderBy('roles.name')->withPivot(['expire_date']);
    }
}
