<?php

namespace App\Notifications;

use App\Channels\SmsChannel;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Kutia\Larafirebase\Facades\Larafirebase;
use Kutia\Larafirebase\Messages\FirebaseMessage;

class OrderAssignedNotification extends Notification
{
    use Queueable;

    public $orderDetails, $driver;

    protected $title, $message, $fcmTokens;

    public function __construct($orderDetails, $driver, $title, $message, $fcmTokens)
    {
        $this->orderDetails = $orderDetails;
        $this->driver = $driver;
        $this->title = $title;
        $this->message = $message;
        $this->fcmTokens = $fcmTokens;
    }

    public function via($notifiable)
    {
        return ['firebase']; // You can add more channels like SMS
        // return ['mail', 'firebase']; // You can add more channels like SMS
    }

    public function toMail($notifiable)
    {
        return (new MailMessage)
            ->subject('New Order Assigned')
            ->line('A new order has been Assigned to you!.')
            ->action('View Order', url('/orders/' . $this->orderDetails->id));
    }

    public function toArray($notifiable)
    {
        return [
            'order_id' => $this->orderDetails->id,
            'message' => 'A new order has been placed'
        ];
    }

    public function toFirebase($notifiable)
    {
        return Larafirebase::withTitle($this->title)
            ->withBody($this->message)
            ->withImage('https://logixsaas.com/wp-content/uploads/2023/08/cropped-Screenshot-from-2023-08-22-09-29-11-180x180.png')
            ->withIcon('https://logixsaas.com/wp-content/uploads/2023/08/cropped-Screenshot-from-2023-08-22-09-29-11-180x180.png')
            ->withSound('default')
            ->withClickAction('https://www.google.com')
            ->withPriority('high')
            ->withAdditionalData([
                'color' => '#rrggbb',
                'badge' => 0,
            ])
            ->sendNotification(env('FIREBASE_TOKEN'));
    }
}
