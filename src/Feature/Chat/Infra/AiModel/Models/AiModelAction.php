<?php

namespace App\Feature\Chat\Infra\AiModel\Models;

use App\Shared\App\Enums\Event;
use Illuminate\Http\Resources\Json\JsonResource;
use stdClass;

final class AiModelAction extends JsonResource
{
    final public function __construct(
        public readonly ?Event $event,
        public readonly array|stdClass $content,
        public readonly bool $executeAppEvent,
        public readonly ?string $response = null
    ) {
    }

    public function toJson($options = 0)
    {
        return json_encode([
            'event' => $this->event,
            'content' => $this->content,
            'executeAppEvent' => $this->executeAppEvent,
            'response' => $this->response
        ], $options);
    }

}