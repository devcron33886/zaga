<?php

namespace App\Observers;

use App\Models\Bar;
use App\Notifications\BarNotification;

class BarObserver
{
    public function created(Bar $bar)
    {
        $bar->notify(new BarNotification($bar));
    }
}
