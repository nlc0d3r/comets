<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class MeetingAdded extends Notification
{
    use Queueable;

    private $ID;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct( $ID )
    {
        $this->ID = $ID;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['mail'];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {

        $url = url('/meetings/' . $this->ID );

        return (new MailMessage)
            ->greeting('Labdien!')
            ->line('Tika izveidota sanāksme')
            ->action('Apskatīt sanāksmi', $url);
    }

    /**
     * Get the array representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function toArray($notifiable)
    {
        return [
            //
        ];
    }
}
