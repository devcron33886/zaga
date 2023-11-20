<?php

namespace App\Models;

use App\Models\Scopes\ReportScope;
use Cknow\Money\Money;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Notifications\Notifiable;

class Bar extends Model
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

    public function formattedBar(): Money
    {
        return Money::RWF($this->bar_amount);
    }

    public function formattedKitchen(): Money
    {
        return Money::RWF($this->kitchen_amount);
    }

    public function formattedBingalo(): Money
    {
        return Money::RWF($this->bingalo_amount);
    }

    public function formattedChamber(): Money
    {
        return Money::RWF($this->chamber_amount);
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
        return Money::RWF($this->total / 30);
    }

    protected static function boot()
    {
        parent::boot();
        static::addGlobalScope(new ReportScope());
    }
}
