<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Menu extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'menus';
    protected $guarded = [];

    protected $casts = [
    	'has_child' => 'boolean',
    	'active' => 'boolean'
    ];

    public function roles() {
    	return $this->belongsToMany(Role::class, 'menus_and_roles')->orderBy('menus.name');
    }
}
