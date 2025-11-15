<?php

namespace App\Exceptions;

use Exception;

class EmployeeNotFoundException extends Exception
{
    public function __construct($message = "There is no Employee", $code = 404)
    {
        parent::__construct($message, $code);
    }
}
