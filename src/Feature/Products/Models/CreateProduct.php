<?php

namespace App\Feature\Products\Models;

use Validator;

class CreateProduct
{
    public function __construct(
        public readonly string $name,
        public readonly float $price,
        public readonly ?string $description = null
    ) {
        Validator::validate(
            [
                'name' => $this->name,
                'price' => $this->price,
                'description' => $this->description,
            ],
            [
                'name' => 'required|string|max:255',
                'price' => 'required|numeric|min:0',
                'description' => 'nullable|string',
            ]
        );
    }
}