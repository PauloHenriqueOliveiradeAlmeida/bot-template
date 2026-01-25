<?php

namespace App\Shared\Infra\Database\Models;

use App\Shared\Infra\Database\Contracts\DefinableFieldsModel;
use Laravel\Scout\Searchable;
use MongoDB\Laravel\Eloquent\Model;



/**
 * @property int $id
 * @property string $event
 * @property array|object $output
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 */
class EventSchema extends Model implements DefinableFieldsModel
{
    use Searchable;

    protected $table = "event_schemas";

    protected $fillable = [
        'event',
        'output'
    ];

    public function toSearchableArray(): array
    {
        return array_merge($this->toArray(), [
            'id' => $this->id,
            'created_at' => $this->created_at->timestamp,
            'updated_at' => $this->updated_at->timestamp
        ]);
    }

    public static function getFields(): array
    {
        return [
            ['name' => 'event', 'type' => 'string'],
            ['name' => 'output', 'type' => 'object']
        ];
    }
}