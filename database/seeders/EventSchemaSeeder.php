<?php

namespace Database\Seeders;

use App\Feature\Products\App\Event\CreateProduct;
use App\Shared\App\Enums\Event;
use App\Shared\Infra\Database\Models\EventSchema;
use Illuminate\Database\Seeder;

class EventSchemaSeeder extends Seeder
{
    public function run(): void
    {
        EventSchema::firstOrCreate(['event' => Event::CREATE_PRODUCT], [
            'event' => Event::CREATE_PRODUCT,
            'output' => CreateProduct::getSchema()
        ]);
    }
}
