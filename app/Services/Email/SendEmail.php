<?php

namespace App\Services\Email;

use App\Jobs\MailDispatcher;
use App\Mail\DefaultMail;
use Illuminate\Support\Facades\Mail;

class SendEmail
{
    const EMAILS_TEMPLATE_FOLDER = 'emails';

    public function send($params)
    {
        if (!empty($params)) {
            $mail = new DefaultMail($params);
            dispatch(new MailDispatcher($mail));
        }
    }
}
