<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ReplyToUser extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($username, $subject, $msg, $signature) {
        $this->username = $username;
        $this->subject = $subject;
        $this->msg = $msg;
        $this->signature = $signature;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->from( config("adminlte.from_email", 'admin@doroosi.com'), config('adminlte.doroosi', 'Doroosi') )
                    ->subject($this->subject)
                    ->view('emails.reply_to_user')
                    ->with(['username' => $this->username, 'msg' => $this->msg ,'signature' =>$this->signature]);
    }
}
