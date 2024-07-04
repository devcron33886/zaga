<?php

namespace App\Notifications;

use App\Models\Sauna;
use Cknow\Money\Money;
use Illuminate\Bus\Queueable;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use NotificationChannels\AfricasTalking\AfricasTalkingChannel;
use NotificationChannels\AfricasTalking\AfricasTalkingMessage;

class SaunaNotification extends Notification
{
    use Queueable;

    public $sauna;

    /**
     * Create a new notification instance.
     */
    public function __construct(Sauna $sauna)
    {
        $this->sauna = $sauna;
    }

    public function via($notifiable): array
    {
        return [AfricasTalkingChannel::class];
    }

    public function toAfricasTalking($notifiable)
    {
        $payout = Sauna::where('employee_id', '=', $this->sauna->employee_id)->sum('payout');

        return (new AfricasTalkingMessage())
            ->content('Uno munsi wakoreye amafaranga '.Money::RWF($payout).' ZAGNUT.')
            ->to($this->sauna->employee->phone_number);
    }
}
