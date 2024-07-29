<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use Benwilkins\FCM\FcmMessage;

class QuoteAccepted extends Notification
{
    use Queueable;

    protected $quote_id;
    protected $title;
    protected $body;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($quote_id='',$title='',$body='')
    {          

       $this->quote_id = $quote_id;
       $this->title = $title;
       $this->body = $body;
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
            'title'        => $this->title,
            'body'         => "",//$this->body, 
           
            'id'           => $this->quote_id,
            'type'         =>2,
            'sound'        => '',  
            'icon'         => '',  
            'click_action' => ''  
        ])->data([
            'title'        => $this->title,
            'body'         => "",//$this->body, 
            'html'         => 'HTML',
            'id'           => $this->quote_id,
            'type'         =>2,
            
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
