<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class RekamUpdateNotification extends Notification
{
    use Queueable;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public $rekams;
    public $message;

    public function __construct($rekams,$message)
    {
        $this->rekams = $rekams;
        $this->message = $message;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['database'];
    }


    public function toArray($notifiable)
    {
        return [
            'id_rekam' => $this->rekams->id,
            'no_rekam' => $this->rekams->no_rekam,
            'created_at' => $this->rekams->created_at,
            'id_pasien' => $this->rekams->pasien_id,
            'nama_pasien' => $this->rekams->pasien->nama,
            'message' => $this->message,
        ];
    }
}
