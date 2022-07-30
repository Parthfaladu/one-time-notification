<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use App\Channels\StoreChannel;
use Carbon\Carbon;

class NewPost extends Notification
{
    use Queueable;

    protected $request;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($request)
    {
        $this->request = $request;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return [StoreChannel::class];
    }

    /**
     * Store notification into table.
     *
     * @param  mixed  $notifiable
     * @return boolean
     */
    public function toStore($notifiable): bool
    {
        $data = [
            "message" => $this->request->get("shortMessage"),
        ];

        $notifiable->notifications()->create([
            "type"              => "App\Notifications\NewPost",
            "notification_type" => $this->request->get("notificationType"),
            "data"              => $data,
            "expire_at"         => Carbon::createFromFormat("d/m/Y", $this->request->get("expireAt"))->format("Y-m-d")
        ]);

        return true;
    }
}
