<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Notifications\Notifiable;

class Employee extends Model
{
    use Notifiable,SoftDeletes;

    protected $guarded = [];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function bars(): HasMany
    {
        return $this->hasMany(Bar::class);
    }

    public function saunas(): HasMany
    {
        return $this->hasMany(Sauna::class);
    }

    public function expenses(): HasMany
    {
        return $this->hasMany(Expense::class);
    }

    protected static function boot()
    {
        parent::boot();
        static::creating(function ($employee) {
            $lastEmployee = static::orderBy('id', 'desc')->first();
            $registrationNumber = 'ZAG-'.sprintf('%05d', ($lastEmployee ? $lastEmployee->id + 1 : 1));
            $employee->code = date('Y').$registrationNumber;
        });
    }
}
