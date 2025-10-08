<?php

namespace App\Exceptions;

use Exception;

class ProductsNotFoundException extends Exception
{
    public function __construct($message = "There Is No Products", $code = 404)
    {
        parent::__construct($message, $code);
    }
}
