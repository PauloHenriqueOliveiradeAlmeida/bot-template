<?php

namespace App\Feature\Chat;

use App\Feature\Chat\App\Event\SendMessage;
use App\Feature\Chat\Entrypoint\Listener\ChatListener;
use App\Feature\Chat\Infra\AiModel\GeminiClient;
use App\Feature\Chat\Infra\AiModel\IAiModel;
use App\Feature\Chat\Infra\Message\IMessage;
use App\Feature\Chat\Infra\Message\WhatsappClient;
use Illuminate\Routing\Router;
use Illuminate\Support\Facades\Event;
use Illuminate\Support\ServiceProvider;

class ChatProvider extends ServiceProvider
{

    public function register()
    {
        $this->app->bind(IAiModel::class, GeminiClient::class);
        $this->app->bind(IMessage::class, WhatsappClient::class);
    }
    public function boot(Router $router)
    {
        Event::listen(
            SendMessage::class,
            ChatListener::class
        );
        $router->name("chat")->group(__DIR__ . "/Entrypoint/Http/routes.php");
    }
}