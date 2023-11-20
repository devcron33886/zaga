<?php

namespace App\Notifications;

use App\Models\Bar;
use Cknow\Money\Money;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use NotificationChannels\AfricasTalking\AfricasTalkingChannel;
use NotificationChannels\AfricasTalking\AfricasTalkingMessage;

class BarNotification extends Notification
{
    use Queueable;

    public $bar;

    /**
     * Create a new notification instance.
     */
    public function __construct(Bar $bar)
    {
        $this->bar = $bar;
    }

    public function via($notifiable): array
    {
        return [AfricasTalkingChannel::class];
    }

    public function toAfricasTalking($notifiable)
    {
        $payout = Bar::where('employee_id', '=', $this->bar->employee_id)->sum('payout');

        return (new AfricasTalkingMessage())
            ->content('Uno munsi wakoreye amafaranga '.Money::RWF($payout).' ZAGNUT.')
            ->to($this->bar->employee->phone_number);
    }
}
