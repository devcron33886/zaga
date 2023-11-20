<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;

use BezhanSalleh\FilamentShield\Traits\HasPanelShield;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable
{
    use HasApiTokens, HasPanelShield,HasRoles,Notifiable,SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
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
        'password' => 'hashed',
    ];

    public function saunaEmpyloyees(): HasMany
    {
        return $this->hasMany(SaunaEmployee::class);
    }

    public function barEmpyloyees(): HasMany
    {
        return $this->hasMany(BarEmployee::class);
    }

    public function saunaEspenses(): HasMany
    {
        return $this->hasMany(SaunaExpenses::class);
    }

    public function barEspenses(): HasMany
    {
        return $this->hasMany(BarExpenses::class);
    }

    public function saunaWorks(): HasMany
    {
        return $this->hasMany(SaunaWork::class);
    }

    public function barWorks(): HasMany
    {
        return $this->hasMany(BarWork::class);
    }
}
