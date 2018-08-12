<?php

namespace App\Http\Controllers;

use App\Services\Email\SendEmail;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class MailController extends Controller
{

    public function send(Request $request)
    {
        $req = $request->all();

        $mailerService = new SendEmail();

        $result = $mailerService->send($req);

        return Response::create($result);
    }
}
