<?php

namespace App\Exceptions;

use Exception;

class CustomersRequestsNotFoundException extends Exception
{
    public function __construct($message = "There is no Customers Requests", $code = 404)
    {
        parent::__construct($message, $code);
    }
}
