<?php

namespace App\Observers;

use App\Models\Sauna;
use App\Notifications\SaunaNotification;

class SaunaObserver
{
    public function created(Sauna $sauna)
    {
        $sauna->notify(new SaunaNotification($sauna));
    }
}
