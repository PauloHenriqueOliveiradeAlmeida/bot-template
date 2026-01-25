<?php

namespace App\Feature\Chat\Infra\Message;

use Twilio\Rest\Client;

class WhatsappClient implements IMessage
{
    private readonly Client $client;
    public function __construct()
    {
        $this->client = new Client(
            config('services.twilio.sid'),
            config('services.twilio.auth_token')
        );
    }

    public function send(string $to, string $message): void
    {
        $this->client->messages->create($to, [
            "body" => $message
        ]);
    }
}