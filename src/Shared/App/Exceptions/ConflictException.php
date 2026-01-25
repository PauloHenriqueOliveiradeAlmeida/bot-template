<?php

namespace App\Shared\App\Exceptions;

use Exception;

class ConflictException extends Exception
{
    final protected $code = 409;
    public function __construct(string $message = "Conflict occurred.")
    {
        parent::__construct($message, $this->code);
    }
}