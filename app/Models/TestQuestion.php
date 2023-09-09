<?php

namespace App\Models;

use App\Traits\UserInCharge;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class TestQuestion extends Model
{
    use HasFactory, SoftDeletes, UserInCharge;

    protected $table = 'test_questions';
    protected $guarded = [];

    public function creator() {
        return $this->belongsTo(User::class, 'created_by');
    }

    public function editor() {
        return $this->belongsTo(User::class, 'updated_by');
    }

    public function terminator() {
        return $this->belongsTo(User::class, 'deleted_by');
    }
}
