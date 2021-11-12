<?php

namespace App\Exceptions\http;

class UnauthorizedHttpException extends HttpException
{
    public function __construct($message, $code = 400, \Exception $previous = null)
    {
        parent::__construct(401, $message, $code, $previous);
    }
}
