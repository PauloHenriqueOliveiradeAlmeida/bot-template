<?php

namespace App\Shared\App\Contracts;

interface DataSchemable
{
    public static function getSchema(): array;
}