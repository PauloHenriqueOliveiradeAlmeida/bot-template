<?php

namespace App\Shared\Infra\Database\Contracts;

interface DefinableFieldsModel
{
    /**
     * @return array<array<'type'|'optional'|'name', mixed>>
     */
    public static function getFields(): array;
}