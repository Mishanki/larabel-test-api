<?php

namespace App\Exceptions\http;

use RuntimeException;
use Throwable;

class HttpException extends RuntimeException
{
    public function __construct($status, $message = "", $code = 0, Throwable $previous = null)
    {
        parent::__construct($message, $code, $previous);
//        http_response_code($status);
    }
}
