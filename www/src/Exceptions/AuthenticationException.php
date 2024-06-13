<?php

namespace App\Exceptions;

use Throwable;

class AuthenticationException extends \Exception

{
    public function __construct(string $message = "", int $code = 0, Throwable $previous = null)
    {
        parent::__construct($message, $code, $previous);
    }
}
