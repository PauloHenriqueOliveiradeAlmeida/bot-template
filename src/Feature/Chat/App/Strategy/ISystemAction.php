<?php

namespace App\Feature\Chat\App\Strategy;

interface ISystemAction
{

    /**
     * @template T
     * @template R
     * @param T $payload
     * @return R
     */
    public function execute(mixed $payload): mixed;
}