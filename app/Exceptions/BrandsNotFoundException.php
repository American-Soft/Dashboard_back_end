<?php

namespace App\Exceptions;

use Exception;

class BrandsNotFoundException extends Exception
{
    public function __construct($message = "There Is No Brands", $code = 404)
    {
        parent::__construct($message, $code);
    }
}
