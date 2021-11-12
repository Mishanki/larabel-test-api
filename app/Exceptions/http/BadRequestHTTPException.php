<?php

namespace App\Exceptions\http;

class BadRequestHTTPException extends HttpException
{
    public function __construct($message, $code = 400, \Exception $previous = null)
    {
        parent::__construct(400, $message, $code, $previous);
    }
}
