<?php

namespace App\Exceptions;


use Mockery\Exception;
use Throwable;

class BusinessLogicException extends Exception
{

    public function __construct($message = "", $code = 0, Throwable $previous = null)
    {
        parent::__construct($message, $code, $previous);
    }

}