<?php

namespace App\Exceptions;

use Illuminate\Auth\AuthenticationException;

class InvalidTokenException extends AuthenticationException
{
    public function __construct($message = 'Invalid access token')
    {
        parent::__construct($message);
    }
}