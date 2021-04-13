<?php

namespace App\Notifications;

use App\Channels\Messages\WhatsAppMessage;
use App\Channels\WhatsAppChannel;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class ZakatCreated extends Notification
{
    use Queueable;

    protected $user;
    protected $transaction;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($transaction)
    {
        $this->user = $transaction->user;
        $this->transaction = $transaction;
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
                ->line('Terimakasih telah berdonasi, silakan segera lakukan pembayaran melalui '.$this->transaction->payment_method->category.' ke')
                ->line('*'.$this->transaction->payment_method->detail_2.' '.$this->transaction->payment_method->short_name.'*')
                ->line('A/N *'.$this->transaction->payment_method->detail_3.'*')
                ->line('Sebesar *Rp'.number_format($this->transaction->amount).'*')
                ->line('')
                ->line('Untuk konfirmasi pembayaran klik link dibawah ini')
                ->line('https://wa.me/')
                ->line(route('transaction.invoice', $this->transaction->invoice));
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
