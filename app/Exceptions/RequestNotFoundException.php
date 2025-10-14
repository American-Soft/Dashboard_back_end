<?php

namespace App\Exceptions;

use Exception;

class RequestNotFoundException extends Exception
{
    public function __construct($message = "There Is No Request", $code = 404)
    {
        parent::__construct($message, $code);
    }
}
