<?php

namespace App\Models;

use App\Traits\HasUuids;
use App\Traits\UserInCharge;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Contract extends Model
{
    use HasFactory, HasUuids, UserInCharge, SoftDeletes;

    protected $table = 'contracts';
    protected $guarded = [];

    public function offering_letter() {
    	return $this->belongsTo(OfferingLetter::class, 'offering_letter_id');
    }
}
