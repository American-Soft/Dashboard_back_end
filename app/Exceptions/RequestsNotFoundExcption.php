<?php

namespace App\Exceptions;

use Exception;

class RequestsNotFoundExcption extends Exception
{
    public function __construct($message = "There Is No Requests Found", $code = 404)
    {
        parent::__construct($message, $code);
    }
}
