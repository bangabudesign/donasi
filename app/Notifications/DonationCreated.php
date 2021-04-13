<?php

namespace App\Notifications;

use App\Channels\Messages\WhatsAppMessage;
use App\Channels\WhatsAppChannel;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class DonationCreated extends Notification
{
    use Queueable;

    protected $user;
    protected $donation;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($donation)
    {
        $this->user = $donation->user;
        $this->donation = $donation;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return [WhatsAppChannel::class];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {
        return (new MailMessage)
                    ->line('The introduction to the notification.')
                    ->action('Notification Action', url('/'))
                    ->line('Thank you for using our application!');
    }

    /**
     * Get the WhatsApp representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return WhatsAppMessage
     */
    public function toWhatsApp($notifiable)
    {
        return (new WhatsAppMessage)
                ->greeting('*Halo!, '.$this->user->name.'*')
                ->line('Terimakasih telah berdonasi, silakan segera lakukan pembayaran melalui '.$this->donation->payment_method->category.' ke')
                ->line('*'.$this->donation->payment_method->detail_2.' '.$this->donation->payment_method->short_name.'*')
                ->line('A/N *'.$this->donation->payment_method->detail_3.'*')
                ->line('Sebesar *Rp'.number_format($this->donation->amount).'*')
                ->line('')
                ->line('Untuk konfirmasi pembayaran klik link dibawah ini')
                ->line('https://wa.me/')
                ->line(route('transaction.invoice', $this->donation->invoice));
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
