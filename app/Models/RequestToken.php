<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class RequestToken extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'request_tokens';
    protected $guarded = [];

    protected $casts = [
    	'completed' => 'boolean',
    	'expired_at' => 'datetime'
    ];

    public function user() {
    	return $this->belongsTo(User::class, 'user_id');
    }
    public function region() {
        return $this->belongsTo(Region::class, 'region_id');
    }
}
