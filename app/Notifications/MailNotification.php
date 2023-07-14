<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
//use App\Models\Announcement;

class MailNotification extends Notification implements ShouldQueue
{
    use Queueable;

    //private Announcement $announcement;
    private $data;
    /**
     * Create a new notification instance.
     */
    public function __construct($data)
    {
        //
        //$this->announcement = $announcement;
        $this->data = $data;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @return array<int, string>
     */
    public function via(object $notifiable): array
    {
        return ['mail'];
    }

    /**
     * Get the mail representation of the notification.
     */
    public function toMail(object $notifiable): MailMessage
    {
        return (new MailMessage)
                    ->subject($this->data['subject'])
                    ->from('ticket.laravel@mail.com')
                    ->line($this->data['body'])
                    ->action('Notification Action', url('/'))
                    ->line('Thank you for using our application!');
    }

    /**
     * Get the array representation of the notification.
     *
     * @return array<string, mixed>
     */
    public function toArray(object $notifiable): array
    {
        return [
            //
        ];
    }

    public function toDatabase(object $notifiable): array
    {
        return [
            'title' => 'New assignment -'. $this->data['name'],
            'body' => $this->data['body'],
        ];
    }
}
