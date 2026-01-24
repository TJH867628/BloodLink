<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class SystemNotificationMail extends Mailable
{
    use Queueable, SerializesModels;

    public string $messageText;

    public function __construct(string $messageText)
    {
        $this->messageText = $messageText;
    }

    public function build()
    {
        return $this->subject('BloodLink Notification')
                    ->view('emails.notification')
                    ->with([
                        'messageText' => $this->messageText
                    ]);
    }
}