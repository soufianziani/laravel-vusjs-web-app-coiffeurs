<?php

namespace App\Notifications;

use App\Models\Reservation;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class ReservationNotification extends Notification
{
    use Queueable;

    protected $reservation;
    protected $storeOwnerName;
    protected $userName;


    public function __construct(Reservation $reservation , $storeOwnerName , $userName)
    {
        $this->reservation = $reservation;
        $this->storeOwnerName = $storeOwnerName;
        $this->userName = $userName;
    }

    public function via($notifiable)
    {
        return ['mail'];
    }

    public function toMail($notifiable)
{
    // $storeOwnerName = $notifiable->owner->name;

    return (new MailMessage)
        ->subject('New Reservation')
        ->line('Hello ' . $this->storeOwnerName . ',')
        ->line('A new reservation has been made at your store from '. $this->userName)
        ->action('View Reservation', url('/owner/dashboard/store/reservation/show/' . $this->reservation->id))
        ->line('Thank you for using our application!');
}


    public function toArray($notifiable)
    {
        return [
            // Additional data if needed
        ];
    }
}
