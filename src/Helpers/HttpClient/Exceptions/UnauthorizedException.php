<?php

namespace yashveersingh\rportPHP\Helpers\HttpClient\Exceptions;

use RuntimeException;

class UnauthorizedException extends RuntimeException
{
    public function __construct(?string $message = null)
    {
        parent::__construct($message ?? 'Request is unauthorized.');
    }
}