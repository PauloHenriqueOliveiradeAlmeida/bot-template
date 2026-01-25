<?php

namespace App\Feature\Chat\Entrypoint\Listener;

use App\Feature\Chat\App\Event\SendMessage;
use App\Feature\Chat\Infra\Message\IMessage;

class ChatListener
{

    public function __construct(
        private readonly IMessage $message
    ) {
    }

    public function handle(SendMessage $message)
    {
        $this->message->send(
            $message->to,
            $message->content
        );
    }
}