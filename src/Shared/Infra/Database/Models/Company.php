<?php

namespace App\Shared\Infra\Database\Models;
use MongoDB\Laravel\Eloquent\Model;

/**
 * @property string $external_id
 * @property string $name
 * @property string $tenant_id
 */
class Company extends Model
{
    protected $table = "company";

    protected $fillable = [
        "external_id",
        "name",
        "tenant_id",
    ];
}