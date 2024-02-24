<?php

namespace App\Channels;

use AfricasTalking\SDK\AfricasTalking;
use Exception;
use Illuminate\Notifications\Notification;

class SmsChannel
{
    public function send($notifiable, Notification $notification)
    {
        return;
        $message = $notification->toSms($notifiable);

        $phone = $notifiable->phone;
        // Add your Africastalking SMS sending logic here
        // You can use the Africastalking API or any other service of your choice
        $phone = ['+254743895505'];
        // $message = 'This is a test';
        $username = env('AFRICASTALKING_USERNAME'); // use 'sandbox' for development in the test environment
        $apiKey   = env('AFRICASTALKING_API_KEY'); // use your sandbox app API key for development in the test environment

        try {
            $AT       = new AfricasTalking($username, $apiKey);
            // Get one of the services
            $sms      = $AT->sms();
            // Use the service
            $result   = $sms->send([
                'enqueue' => true,
                // 'from'    => $username,
                'to'      => $phone,
                'message' => $message
            ]);
            return $result;
        } catch (Exception $e) {
            // return;
            dd($e);
        }
    }
}
