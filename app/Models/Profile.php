<?php

namespace App\Models;

use App\Traits\HasUuids;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Profile extends Model
{
    use HasFactory, HasUuids, SoftDeletes;

    protected $table = 'profiles';

    protected $guarded = [];

    public function user() {
        return $this->belongsTo(User::class, 'user_id');
    }
    public function candidate() {
        return $this->hasOne(Candidate::class, 'profile_id');
    }

    public function employee() {
        return $this->hasOne(Employee::class, 'profile_id');
    }
}
