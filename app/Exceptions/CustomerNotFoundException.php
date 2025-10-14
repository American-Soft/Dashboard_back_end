<?php

namespace App\Exceptions;

use Exception;

class CustomerNotFoundException extends Exception
{
    public function __construct($message = "There is no Customer", $code = 404)
    {
        parent::__construct($message, $code);
    }
}
