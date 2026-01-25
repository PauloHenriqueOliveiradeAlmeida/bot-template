<?php

namespace App;

use App\Feature\Chat\ChatProvider;
use App\Feature\Products\ProductProvider;
use Illuminate\Config\Repository;
use Illuminate\Foundation\Application;
use Illuminate\Support\DefaultProviders;


final class Providers
{

    public function register()
    {
        return [
            ChatProvider::class,
            ProductProvider::class,
        ];
    }

    public function bootstrap(Application $app): void
    {
        $providers = new DefaultProviders()
            ->merge($this->register())
            ->toArray();

        $app->get(Repository::class)
            ->set('app.providers', $providers);
    }
}
