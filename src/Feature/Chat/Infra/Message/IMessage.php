<?php

namespace App\Feature\Chat\Infra\Message;

interface IMessage
{
    public function send(string $to, string $content): void;
}