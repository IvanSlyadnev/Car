<?php

namespace App\Models;

use App\Traits\CrossingPeriodFeature;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Carbon;

class Car extends Model
{
    use HasFactory, SoftDeletes, CrossingPeriodFeature;

    protected $fillable = [
        'name', 'color', 'brand_id', 'number'
    ];

    public function users() {
        return $this->belongsToMany(User::class, 'car_user')->withPivot(['start', 'end']);
    }

    public function brand() {
        return $this->belongsTo(Brand::class, 'brand_id');
    }

    public function getActiveNowUserAttribute() {
        return $this->users()->crossingPeriod(Carbon::now())->first();
    }

    public function getActiveUser(Carbon $date) {
        return $this->users()->crossingPeriod($date)->first();
    }

    public function canBeReserved(Carbon $start, Carbon $end) {
        return !$this->users()->crossingPeriod($start, $end)->exists();
    }
}
