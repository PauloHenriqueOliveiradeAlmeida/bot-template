<?php

namespace App\Feature\Chat\App\Strategy;

use App\Feature\Products\App\Service\ProductService;
use App\Feature\Products\Models\CreateProduct;

class CreateProductAction implements ISystemAction
{
    /**
     * @param CreateProduct $payload
     */
    public function execute(mixed $payload): CreateProduct
    {
        return app(ProductService::class)->create(
            new CreateProduct(
                name: $payload->name,
                price: \floatval($payload->price),
                description: $payload->description,
            )
        );
    }
}