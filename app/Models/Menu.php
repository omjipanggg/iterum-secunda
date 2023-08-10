<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Menu extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'menu';
    protected $guarded = [];

    protected $casts = [
    	'has_child' => 'boolean',
    	'active' => 'boolean'
    ];

    public function roles() {
    	return $this->belongsToMany(Role::class, 'menu_and_roles')->orderBy('menu.name');
    }
}
