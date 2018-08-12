<?php

namespace App\Services\Email;

use App\Jobs\MailDispatcher;
use Illuminate\Support\Facades\Mail;
use Illuminate\Http\Response;

class SendEmail
{
    public function send($params)
    {
        if (!empty($params)) {
            $template = "App\\Mail\\" . $params['template'] . "Mail";

            if (!class_exists($template)) {
                return array('message' => 'invalid template', 'error' => true);
            }

            $reflectionClass = new \ReflectionClass($template);

            $mail = new $reflectionClass->name($params);
            dispatch(new MailDispatcher($mail));

            return array('message' => 'e-mail delivered', 'error' => false);
        }
        
        return array('message' => 'missing attributes', 'error' => false);
    }
}
