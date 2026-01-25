<?php

namespace App\Shared\App\States;

use Illuminate\Support\Collection;

class Tenant
{
    private static string $id;

    /**
     * @var Collection<string> $phones
     */
    private static Collection $phones;

    public static function getId(): string
    {
        return self::$id;
    }

    /**
     * @return Collection<string>
     */
    public function getPhones(): Collection
    {
        return self::$phones;
    }

    public static function define(
        string $id,
        array $phones = []
    ) {
        static::$id = $id;
        static::$phones = Collection::make($phones);

        return new self();
    }
}