<?php

namespace App\Feature\Chat\App\Service;
use App\Feature\Chat\App\Strategy\SystemActionHandler;
use App\Feature\Chat\Infra\AiModel\IAiModel;

class ChatService
{
    public function __construct(
        private readonly IAiModel $aiModel,
        private readonly SystemActionHandler $systemActionHandler
    ) {
    }

    public function dispatchEventFromMessage(string $message)
    {
        $action = $this->aiModel->prompt([$message]);
        if (!$action->executeAppEvent)
            return $action->response;

        try {
            $systemAction = $this->systemActionHandler->resolve($action->event);
            $systemAction->execute($action->content);
            return $action->response;
        } catch (\Exception $e) {
            return $e->getMessage();
        }
    }
}