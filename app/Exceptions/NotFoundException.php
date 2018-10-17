<?php
/**
 * Created by PhpStorm.
 * User: servidor
 * Date: 16/10/18
 * Time: 17:09
 */

namespace App\Exceptions;


use Throwable;

class NotFoundException extends \Exception
{
    public function __construct($message = MessageException::NOT_FOUND, $code = 0, Throwable $previous = null)
    {
        parent::__construct($message, $code, $previous);
    }

}