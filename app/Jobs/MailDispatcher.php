<?php

namespace App\Jobs;

use Illuminate\Contracts\Mail\Mailable;
use Illuminate\Support\Facades\Mail;

class MailDispatcher extends Job
{
    public $mail;

    public function __construct(Mailable $mail)
    {
        $this->mail = $mail;
    }

    public function handle()
    {
        Mail::send($this->mail);
    }
}
