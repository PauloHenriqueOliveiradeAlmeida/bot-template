<?php

namespace App\Feature\Products;

use App\Feature\Products\App\Event\CreateProduct;
use App\Feature\Products\Entrypoint\Listener\ProductListener;
use Illuminate\Support\Facades\Event;
use Illuminate\Support\ServiceProvider;

class ProductProvider extends ServiceProvider
{
    public function boot()
    {
        Event::listen(
            CreateProduct::class,
            ProductListener::class
        );
    }
}