<?php
namespace App\Channels;

use Illuminate\Notifications\Notification;

class WhatsAppChannel
{
    public function send($notifiable, Notification $notification)
    {
        $message = $notification->toWhatsApp($notifiable);

        if (! $notifiable->routeNotificationForWhatsApp()) {
            return;
        }

        $messageText = urlencode($message->greetingText).'%0A';
        foreach ($message->outroLines as $line) {
            $messageText .= '%0A'.urlencode($line);
        }
        
        $number = '62'.$notifiable->routeNotificationForWhatsApp();

        // rapiwha configuration
        $curl = curl_init();
        $api_key = config('services.wa.api_key');

        curl_setopt_array($curl, array(
            CURLOPT_URL => "https://panel.rapiwha.com/send_message.php?apikey=".$api_key."&number=".$number."&text=".$messageText,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "GET",
        ));

        $response = curl_exec($curl);
        $err = curl_error($curl);

        curl_close($curl);
    }
}