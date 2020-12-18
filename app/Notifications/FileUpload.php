<?php

namespace App\Notifications;

use Carbon\Carbon;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class FileUpload extends Notification
{
    use Queueable;

    private $pdfFile;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($pdfFile)
    {
        $this->pdfFile = $pdfFile;
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
        $name = "report" . Carbon::now()->timestamp . ".pdf";

        return (new MailMessage)
            ->line('A new file have been uploaded to the platform.')
            ->attachData($this->pdfFile, $name)
            ;
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
