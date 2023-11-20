<?php

namespace App\Models;

use App\Models\Scopes\SaunaScope;
use Cknow\Money\Money;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Notifications\Notifiable;

class Sauna extends Model
{
    use Notifiable,SoftDeletes;

    protected $guarded = [];

    protected $with = ['employee'];

    public function employee(): BelongsTo
    {
        return $this->belongsTo(Employee::class);
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Route notifications for the Africas Talking channel.
     *
     * @param  \Illuminate\Notifications\Notification  $notification
     * @return string
     */
    public function routeNotificationForAfricasTalking($notification)
    {
        return $this->employee->phone_number;
    }

    public function formattedSauna(): Money
    {
        return Money::RWF($this->sauna);
    }

    public function formattedMassage(): Money
    {
        return Money::RWF($this->massage);
    }

    public function formattedGym(): Money
    {
        return Money::RWF($this->gym);
    }

    public function formattedBarAndKicthen(): Money
    {
        return Money::RWF($this->bar_and_kitchen);
    }

    public function formattedCashIn(): Money
    {
        return Money::RWF($this->cash_in);
    }

    public function formattedCashOut(): Money
    {
        return Money::RWF($this->cash_out);
    }

    public function formattedPayOut(): Money
    {
        return Money::RWF($this->payout);
    }

    public function formattedTotal(): Money
    {
        return Money::RWF($this->total);
    }

    public function formatedPercentage(): Money
    {
        return Money::RWF($this->total / 10);
    }

    protected static function boot()
    {
        parent::boot();
        static::addGlobalScope(new SaunaScope());
    }
}
