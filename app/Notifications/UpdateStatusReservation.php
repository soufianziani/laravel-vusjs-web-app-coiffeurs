<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class UpdateStatusReservation extends Notification
{
    use Queueable;

    protected $userName;
    protected $userEmail;
    protected $storeName;
    protected $status;

    /**
     * Create a new notification instance.
     */
    public function __construct($userName, $userEmail, $storeName, $status)
    {
        $this->userName = $userName;
        $this->userEmail = $userEmail;
        $this->storeName = $storeName;
        $this->status = $status;
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
            ->subject('Update Rserevation')
            ->line('Hello ' . $this->userName . ',')
            ->line('Your Reservation Status is '. $this->status .' from store '.$this->storeName)
            ->action('Go to your  dashboard', url('/dashboard'))
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
}
