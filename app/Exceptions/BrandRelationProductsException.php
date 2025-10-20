<?php

namespace App\Exceptions;

use Exception;

class BrandRelationProductsException extends Exception
{
    public function __construct($message = "Brand And Product Does Not Match", $code = 400)
    {
        parent::__construct($message, $code);
    }
}
