<?php

namespace App\Exceptions;

use Exception;

class BrandNotFoundException extends Exception
{
    public function __construct($message = "There Is No Brand", $code = 404)
    {
        parent::__construct($message, $code);
    }
}
