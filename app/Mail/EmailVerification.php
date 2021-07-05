<?php

namespace App\Mail;

use App\User;
use App\Models\ContactUsMail;  
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;


class EmailVerification extends Mailable
{
    use Queueable, SerializesModels;

    public  $user;

    public  $url;

    public  $subject;
    
    public  $arrayData;

    public  $otp;
    
    public  $contactusmail;


    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($contactusmail, $subject, $arrayData)
    {
        $this->contactusmail     = $contactusmail;

        $this->subject  = $subject;

        $this->arrayData  = $arrayData;

        // $this->url      = $url;

        // $this->user     = $user;

        // $this->otp      = $otp;
    }

    // /**
    //  * Build the message.
    //  *
    //  * @return $this
    //  */
    // public function build()
    // { 
    //     return $this->subject($this->subject)
    //                 ->view('website.email.email_verification')->with(['user'=> $this->user, 'url'=> $this->url, 'otp'=> $this->otp]);
    // }


    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    { 

        $data       = $this->arrayData;
        $name       = $data['first_name'].' '.$data['last_name'];
        $mobile     = $data['mobile'];
        $email      = $data['email'];
        // $messageData   = $data['message'];

        return $this->subject($this->subject)
                    ->view('website.email.send-mail')->with(['contactusmail'=> $this->contactusmail, 'name'=> $name, 'mobile'=> $mobile, 'email'=> $email]);
    }
}
