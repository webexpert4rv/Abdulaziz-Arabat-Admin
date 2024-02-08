<?php

namespace App\Notifications\User;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use Benwilkins\FCM\FcmMessage;

class NewRequestReceived extends Notification
{
    use Queueable;

    protected $job_id;
    protected $quoteCount;
    protected $accountType;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($job_id='' ,$quoteCount='',$accountType='')
    {          

        $this->job_id = $job_id;
       $this->quoteCount = $quoteCount;
       $this->accountType = $accountType;
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

        return (new MailMessage)
        ->subject('New job post')
        ->from('admin@arabat.jobs','Request for quote')
        ->line('The introduction to the notification.')
        //->action('Notification Action', url('/'))
        ->line('Thank you for using our application!');
    }



    public function toFcm($notifiable) 
    {

        $message = new FcmMessage();
        $message->content([
            'title'        => 'New Job Request Received!', 
            'body'         => 'You have received a new job request.',
            'account_type' =>$this->accountType,
            'quote_count' =>$this->quoteCount, 
            'sound'        => '',  
            'icon'         => '',  
            'click_action' => ''  
        ])->data([
            'id'           => $this->job_id,
            'title'        => 'New Job Request Received!', 
            'body'         => 'You have received a new job request.',
            'type'          =>2,
            'account_type'  =>$this->accountType,
            'quote_count'   =>$this->quoteCount,


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
