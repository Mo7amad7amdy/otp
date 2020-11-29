<?php


namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
class CustomMail  extends Mailable
{
    use Queueable, SerializesModels;

    public $username, $subject, $body, $btnText, $btnUrl, $emailFrom;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($array)
    {
        $this->subject   = isset($array['subject']) ? $array['subject'] : 'OTP Password';
        $this->body      = isset($array['body']) ? $array['body'] : null;
        $this->emailFrom = isset($array['emailFrom']) ? $array['emailFrom'] : 'mohammad@project.com';
        $this->btnText   = isset($array['btnText']) ? $array['btnText'] : null;
        $this->btnUrl    = isset($array['btnUrl']) ? $array['btnUrl'] : null;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->markdown('emails.welcome')->subject($this->subject)->from($this->emailFrom);
    }
}
