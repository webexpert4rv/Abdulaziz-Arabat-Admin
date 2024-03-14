<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use Benwilkins\FCM\FcmMessage;

class TransporterAssignment extends Notification
{
    use Queueable;

    protected $job_id;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($job_id='')
    {          

       $this->job_id = $job_id;
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
            'id'            =>$this->job_id,
            'title'        => 'Driver Assigned', 
            'body'         => 'New job Driver Assigned successfully.', 
            'type'         =>  1,
            'sound'        => '',  
            'icon'         => '',  
            'click_action' => ''  
        ])->data([
            'id'            =>$this->job_id,
            'title'        => 'Driver Assigned', 
            'body'         => 'New job Driver Assigned successfully.',            
            'type'         =>  1,
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
