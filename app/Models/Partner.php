<?php

namespace App\Models;

use App\Traits\HasUuids;
use App\Traits\UserInCharge;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Partner extends Model
{
    use HasFactory, HasUuids, SoftDeletes, UserInCharge;

    protected $table = 'partners';
    protected $guarded = [];

    public function city() {
    	return $this->belongsTo(City::class, 'city_id');
    }

    public function region() {
    	return $this->belongsTo(Region::class, 'region_id');
    }

    public function scopeYearlyCount($query) {
        $starting_date = mktime(0, 0, 0, 1, 1, date("Y"));
        $starting_date = date("Y-m-d", $starting_date);

        $ending_date = mktime(0, 0, 0, 12, 31, date("Y"));
        $ending_date = date("Y-m-d", $ending_date);

        return $query->whereBetween('created_at', [$starting_date, $ending_date])
            ->orderByDesc('created_at')
            ->get()
            ->groupBy(function ($vacancy) { return $vacancy->created_at->format('M'); })
            ->map(function ($vacancyGroup) { return $vacancyGroup->count(); });
    }
}
