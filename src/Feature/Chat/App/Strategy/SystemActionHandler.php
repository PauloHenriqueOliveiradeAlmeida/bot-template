<?php

namespace App\Feature\Chat\App\Strategy;

use App\Shared\App\Enums\Event;

class SystemActionHandler
{
    /**
     * @var array<Event, class-string<ISystemAction>>
     */
    private array $actions = [
        Event::CREATE_PRODUCT->value => CreateProductAction::class,
    ];


    public function resolve(Event $event): ISystemAction
    {
        if (!isset($this->actions[$event->value])) {
            throw new \InvalidArgumentException("No action registered for event: $event->value");
        }

        return app($this->actions[$event->value]);
    }
}