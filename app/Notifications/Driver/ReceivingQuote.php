<?php

namespace App\Notifications\Driver;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use Benwilkins\FCM\FcmMessage;

class ReceivingQuote extends Notification
{
    use Queueable;

    protected $quote_id;
    protected $quoteCount;
    protected $accountType;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($quote_id='',$quoteCount='',$accountType='')
    {          

       $this->quote_id = $quote_id;
   }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
       return ['fcm'];
   }

    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {

         
    }



    public function toFcm($notifiable) 
    {

        $message = new FcmMessage();
        $message->content([
            'title'        => 'Received new quote', 
            'body'         => 'Your have received new quote.', 
            'type'         =>2,
            'account_type' =>$this->accountType,
            'quote_count'  =>$this->quoteCount,
            'sound'        => '',  
            'icon'         => '',  
            'click_action' => ''  
        ])->data([
            'id'           => $this->quote_id,
            'title'        => 'Received new quote', 
            'body'         => 'Your have received new quote.',
            'type'         =>2,
            'account_type' =>$this->accountType,
            'quote_count'  =>$this->quoteCount,

        ])->priority(FcmMessage::PRIORITY_HIGH); // Optional - Default is 'normal'.
        // dd($message);
        return $message;
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
