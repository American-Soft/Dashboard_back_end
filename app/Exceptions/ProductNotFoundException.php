<?php

namespace App\Exceptions;

use Exception;

class ProductNotFoundException extends Exception
{
    public function __construct($message = "There Is No Product", $code = 404)
    {
        parent::__construct($message, $code);
    }
}
