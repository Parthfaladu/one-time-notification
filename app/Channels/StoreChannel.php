<?php
namespace App\Channels;

use Illuminate\Notifications\Notification;

class StoreChannel
{
    /**
     * Send the given notification.
     *
     * @param  mixed  $notifiable
     * @param  \Illuminate\Notifications\Notification  $notification
     * @return void
     */
    public function send($notifiable, Notification $notification)
    {
        $message = $notification->toStore($notifiable);
    }
}
