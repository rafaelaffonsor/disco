<?php

namespace App\Tests;

use App\Services\Email\SendEmail;
use Illuminate\Support\Facades\Mail;

class MailTest extends \TestCase
{

    public function testShouldNotWorkWithInvalidRoutes()
    {
        $this->get('/');
        $this->post('/');
        $this->assertResponseStatus(404);
    }

    public function testShouldNotWorkWithoutArguments()
    {
        $this->expectException('ArgumentCountError');

        $mailerService = new SendEmail();

        $mailerService->send();
    }

    public function testShouldNotWorkWithoutTemplate()
    {
        Mail::fake();

        $mock = $this->getMockWrongBody();

        $this->json('POST', '/send', $mock)
            ->seeJson([
                'message' => 'invalid template',
                'error' => true
            ]);
    }

    public function testShouldWork()
    {
        Mail::fake();

        $mock = $this->getMockBody();

        $this->json('POST', '/send', $mock)
            ->seeJson([
                'message' => 'e-mail delivered',
                'error' => false
            ]);
    }

    public function testShouldWorkCallingService()
    {
        Mail::fake();

        $mock = $this->getMockBody();
        $mailerService = new SendEmail();

        $response = $mailerService->send($mock);

        $expected = array('message' => 'e-mail delivered', 'error' => false);

        $this->assertEquals($expected, $response);
    }

    private function getMockBody()
    {
        return [
            "from" => [
                "name" => "Rafael",
                "email" => "rafael_affonsor@yahoo.com.br"
            ],
            "to" => ["rafaelaffonsor@gmail.com", "rafael_affonsor@yahoo.com.br"],
            "cc" => [],
            "subject" => "test",
            "body" => [],
            "template" => "Another",
            "attachments" => []
        ];
    }

    private function getMockWrongBody()
    {
        return [
            "from" => [
                "name" => "Rafael",
                "email" => "rafael_affonsor@yahoo.com.br"
            ],
            "to" => ["rafaelaffonsor@gmail.com", "rafael_affonsor@yahoo.com.br"],
            "cc" => [],
            "subject" => "test",
            "body" => [],
            "template" => "Test",
            "attachments" => []
        ];
    }
}
