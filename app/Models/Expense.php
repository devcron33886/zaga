<?php

namespace App\Models;

use App\Models\Scopes\ExpenseScope;
use Cknow\Money\Money;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class Expense extends Model
{
    use SoftDeletes;

    protected $guarded = [];

    protected $with = ['employee'];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function employee(): BelongsTo
    {
        return $this->belongsTo(Employee::class);
    }

    public function formattedPrice(): Money
    {
        return Money::RWF($this->price);
    }

    public function formattedTotal(): Money
    {
        return Money::RWF($this->total);
    }

    protected static function boot()
    {
        parent::boot();
        static::addGlobalScope(new ExpenseScope());
    }
}
