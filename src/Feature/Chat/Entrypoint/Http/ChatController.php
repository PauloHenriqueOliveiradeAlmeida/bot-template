<?php

namespace App\Feature\Chat\Entrypoint\Http;

use App\Feature\Chat\App\Service\ChatService;
use Illuminate\Routing\Controller;
use Illuminate\Http\Request;

class ChatController extends Controller
{
    final public function __construct(
        private readonly ChatService $chatService
    ) {
    }

    public function webhook(Request $request)
    {
        $message = $request->input('Body');
        $response = $this->chatService->dispatchEventFromMessage($message);
        return [
            'response' => $response
        ];
    }
}