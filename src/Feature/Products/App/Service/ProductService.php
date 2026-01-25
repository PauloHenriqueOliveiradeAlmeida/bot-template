<?php

namespace App\Feature\Products\App\Service;

use App\Feature\Products\Infra\Database\Models\Product;
use App\Feature\Products\Models\CreateProduct;
use App\Shared\App\Exceptions\ConflictException;
use Cknow\Money\Money;

final class ProductService
{
    public function __construct(
        private readonly Product $product
    ) {
    }

    public function create(CreateProduct $product): CreateProduct
    {
        $productAlreadyExists = $this->product->where('name', $product->name)->first();
        if ($productAlreadyExists)
            throw new ConflictException("Produto '{$product->name}' já existe.");

        $price = Money::BRL($product->price);
        $this->product->create([
            'name' => $product->name,
            'price' => \intval($price->getAmount()),
            'description' => $product->description,
        ]);

        return $product;
    }

    public function getAll()
    {
        return $this->product->all()->toArray();
    }

    public function update(int|string $id, array $data)
    {
        $product = $this->product->findOrFail($id);
        $product->update($data);

        return $product->refresh()->toArray();
    }
}
