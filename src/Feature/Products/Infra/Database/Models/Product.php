<?php

namespace App\Feature\Products\Infra\Database\Models;

use App\Shared\Infra\Database\Contracts\DefinableFieldsModel;
use App\Shared\Infra\Database\Models\PrivateModel;
use Laravel\Scout\Searchable;

class Product extends PrivateModel implements DefinableFieldsModel
{
    use Searchable;

    protected $table = "products";

    protected $fillable = [
        'name',
        'price',
        'description',
    ];

    public static function getFields(): array
    {
        return [
            ['name' => 'name', 'type' => 'string'],
            ['name' => 'price', 'type' => 'int64'],
            ['name' => 'description', 'type' => 'string'],
        ];
    }
}