<?php

namespace App\Mail;

use App\User;
use App\Models\UsersOtp;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;


class ForgotOtpVerification extends Mailable
{
    use Queueable, SerializesModels;

    public  $user;

    public  $url;

    public  $subject;

    public  $message;

    public  $otp;
    

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($user, $url, $subject, $otp)
    {
        $this->user     = $user;

        $this->subject  = $subject;

        // $this->message  = $message;

        $this->url      = $url;

        $this->otp      = $otp;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    { 
        return $this->subject($this->subject)
                    ->view('website.email.email_verification')->with(['user'=> $this->user, 'url'=> $this->url, 'otp'=> $this->otp]);
    }


   
}
