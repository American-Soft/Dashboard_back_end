<?php

namespace App\Exceptions;

use Exception;

class UserNotFoundException extends Exception
{
    public function __construct($message = "There is no user", $code = 404)
    {
        parent::__construct($message, $code);
    }
}
