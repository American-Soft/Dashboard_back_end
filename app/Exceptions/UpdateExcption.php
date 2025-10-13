<?php

namespace App\Exceptions;

use Exception;

class UpdateExcption extends Exception
{
    public function __construct($message = "No changes detected", $code = 400)
    {
        parent::__construct($message, $code);
    }
}