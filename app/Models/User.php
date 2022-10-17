<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use App\Traits\CrossingPeriodFeature;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Carbon;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable, SoftDeletes, CrossingPeriodFeature, HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'is_admin'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function cars() {
        return $this->belongsToMany(Car::class, 'car_user')->withPivot(['start', 'end']);
    }

    public function getActiveNowCarAttribute() {
        return $this->cars()->crossingPeriod(Carbon::now())->first();
    }

    public function getActiveCar(Carbon $date) {
        return $this->cars()->crossingPeriod($date)->first();
    }

    public function isAdmin() {
        return $this->is_admin;
    }

    public function canReserve(Carbon $start, Carbon $end) {
        return !$this->cars()->crossingPeriod($start, $end)->exists();
    }


}
