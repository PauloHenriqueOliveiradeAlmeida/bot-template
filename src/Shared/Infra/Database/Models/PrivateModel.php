<?php

namespace App\Shared\Infra\Database\Models;

use App\Shared\App\States\Tenant;
use Illuminate\Database\Eloquent\Builder;
use MongoDB\Laravel\Eloquent\Model;

/**
 * @property string $tenant_id
 */
abstract class PrivateModel extends Model
{

    protected static function booted(): void
    {
        static::addGlobalScope('tenant', function (Builder $builder) {
            $tenantId = Tenant::getId();
            if (!empty($tenantId))
                $builder->where('tenant_id', $tenantId);

        });

        static::creating(function (PrivateModel $model) {
            $tenantId = Tenant::getId();
            if (!empty($tenantId))
                $model->tenant_id = $tenantId;
        });
    }

    public function scopeWithoutTenant($query): Builder
    {
        return $query->withoutGlobalScope('tenant');
    }
}