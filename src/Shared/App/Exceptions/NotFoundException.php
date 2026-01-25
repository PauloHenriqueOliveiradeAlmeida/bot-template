<?php

namespace App\Shared\App\Exceptions;

use Exception;

class NotFoundException extends Exception
{
    final protected $code = 404;

    public function __construct(string $message = "Resource not found.")
    {
        parent::__construct($message, $this->code);
    }
}