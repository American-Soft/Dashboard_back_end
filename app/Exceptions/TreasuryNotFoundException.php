<?php

namespace App\Exceptions;

use Exception;

class TreasuryNotFoundException extends Exception
{
    public function __construct($message = "There Is No Treasury", $code = 404)
    {
        parent::__construct($message, $code);
    }
}
