<?php

namespace App\Exceptions;

use Exception;

class UsersNotFoundException extends Exception
{
    public function __construct($message = "There is no users", $code = 404)
    {
        parent::__construct($message, $code);
    }
}
