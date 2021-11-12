<?php

namespace App\Exceptions\http;

class ForbiddenHttpException extends HttpException
{
    public function __construct($message, $code = 400, \Exception $previous = null)
    {
        parent::__construct(403, $message, $code, $previous);
    }
}
